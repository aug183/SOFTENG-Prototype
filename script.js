/* exported gapiLoaded */
/* exported gisLoaded */
/* exported handleAuthClick */
/* exported handleSignoutClick */

// TODO(developer): Set to client ID and API key from the Developer Console
const CLIENT_ID = '900928121001-jls75n6ckehejstevuinap9n52fu2tqf.apps.googleusercontent.com';
const API_KEY = 'AIzaSyC-pJQ2-eqQACRkDknQpycqL9rPSiOaU_0';

// Discovery doc URL for APIs used by the quickstart
const DISCOVERY_DOC = 'https://sheets.googleapis.com/$discovery/rest?version=v4';

// Authorization scopes required by the API; multiple scopes can be
// included, separated by spaces.
const SCOPES = 'https://www.googleapis.com/auth/spreadsheets';

let tokenClient;
let gapiInited = false;
let gisInited = false;

document.getElementById('signIn_Button').style.display = 'none';
document.getElementById('submit_button').style.display = 'none';
document.getElementById('logout_button').style.display = 'none';
document.getElementById('name').disabled = true;
document.getElementById('email').disabled = true;
document.getElementById('organization').disabled = true;
document.getElementById('reserveItem').disabled = true;
document.getElementById('Date').disabled = true;
document.getElementById('startTime').disabled = true;
document.getElementById('endTime').disabled = true;

/**
 * Callback after api.js is loaded.
 */
function gapiLoaded() {
gapi.load('client', initializeGapiClient);
}

/**
 * Callback after the API client is loaded. Loads the
 * discovery doc to initialize the API.
 */
async function initializeGapiClient() {
await gapi.client.init({
    apiKey: API_KEY,
    discoveryDocs: [DISCOVERY_DOC],
});
gapiInited = true;
maybeEnableButtons();
}

/**
 * Callback after Google Identity Services are loaded.
 */
function gisLoaded() {
tokenClient = google.accounts.oauth2.initTokenClient({
    client_id: CLIENT_ID,
    scope: SCOPES,
    callback: '', // defined later
});
gisInited = true;
maybeEnableButtons();
}

/**
 * Enables user interaction after all libraries are loaded.
 */
function maybeEnableButtons() {
if (gapiInited && gisInited) {
    document.getElementById('signIn_Button').style.display = 'inline';
}
}

/**
 *  Sign in the user upon button click.
 */
function handleAuthClick() {
    tokenClient.callback = async (resp) => {
        if (resp.error !== undefined) {
        throw (resp);
        }
    
        document.getElementById('signIn_Button').style.display = 'none';
        document.getElementById('submit_button').style.display = 'inline';
        document.getElementById('logout_button').style.display = 'inline';
        document.getElementById('name').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('organization').disabled = false;
        document.getElementById('reserveItem').disabled = false;
        document.getElementById('Date').disabled = false;
        document.getElementById('startTime').disabled = false;
        document.getElementById('endTime').disabled = false;
        await listOrganizations();
        await listServices();
    };

    if (gapi.client.getToken() === null) {
        // Prompt the user to select a Google Account and ask for consent to share their data
        // when establishing a new session.
        tokenClient.requestAccessToken({prompt: 'consent'});
    } else {
        // Skip display of account chooser and consent dialog for an existing session.
        tokenClient.requestAccessToken({prompt: ''});
    }
}

/**
 *  Sign out the user upon button click.
 */
function handleSignoutClick() {
const token = gapi.client.getToken();
if (token !== null) {
    google.accounts.oauth2.revoke(token.access_token);
    gapi.client.setToken('');
    document.getElementById('signIn_Button').style.display = 'inline';
    document.getElementById('submit_button').style.display = 'none';
    document.getElementById('logout_button').style.display = 'none';
    document.getElementById('name').disabled = true;
    document.getElementById('email').disabled = true;
    document.getElementById('organization').disabled = true;
    document.getElementById('reserveItem').disabled = true;
    document.getElementById('Date').disabled = true;
    document.getElementById('startTime').disabled = true;
    document.getElementById('endTime').disabled = true;
    
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('organization').value = '';
    document.getElementById('reserveItem').value = '';
    document.getElementById('Date').value = '';
    document.getElementById('startTime').value = '';
    document.getElementById('endTime').value = '';
}
}

async function listOrganizations() {
let response;
try {
    response = await gapi.client.sheets.spreadsheets.values.get({
    spreadsheetId: '1yNVhLxJUSHp7tI05NrjId1sOQrI1hoDIIwozPXXJ-xA',
    range: 'Organizations!A2:B',
    });
} catch (err) {
    return;
}
const range = response.result;
if (!range || !range.values || range.values.length == 0) {
    return;
}

var values = range.values;
var select = document.getElementById('organization');

for (var x = 0; x < values.length; x++)
{
    var option = document.createElement("option");
    option.text = values[x][0];
    option.value = values[x][1];
    select.add(option);
}
}

async function listServices() {
    let response;
    try {
        response = await gapi.client.sheets.spreadsheets.values.get({
        spreadsheetId: '1yNVhLxJUSHp7tI05NrjId1sOQrI1hoDIIwozPXXJ-xA',
        range: 'Services!A2:A',
        });
    } catch (err) {
        return;
    }
    const range = response.result;
    if (!range || !range.values || range.values.length == 0) {
        return;
    }
    
    var values = range.values;
    var select = document.getElementById('reserveItem');
    
    for (var x = 0; x < values.length; x++)
    {
        var option = document.createElement("option");
        option.text = values[x][0];
        option.value = values[x][0];
        select.add(option);
    }
}

function reserveAction() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var organization = document.getElementById('organization').value;
    var reserveItem = document.getElementById('reserveItem').value;
    var date = document.getElementById('Date').value;
    var startTime = document.getElementById('startTime').value;
    var endTime = document.getElementById('endTime').value;
    var values = [[name, email, organization, reserveItem, date, startTime, endTime]];

    try {
        gapi.client.sheets.spreadsheets.values.append({
            spreadsheetId: '1yNVhLxJUSHp7tI05NrjId1sOQrI1hoDIIwozPXXJ-xA',
            range: 'Reservations!A2',
            valueInputOption: "USER_ENTERED",
            resource: {
            values: values
            }
        }).then((response) => {
            const result = response.result;
            console.log(`${result.updatedCells} cells updated.`);
            if (callback) callback(response);
        });
    }
    catch (err) {
        document.getElementById('content').innerText = err.message;
        return;
    }  
}
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// Function to validate email format
function validateEmail(email) {
	const re = /\S+@\S+\.\S+/;
	return re.test(email);
  }
  
  // Function to validate password strength
 // Function to validate email format with specific domain
   function validateEmail(email) {
	const re = /^[a-zA-Z0-9._%+-]+@dlsl\.edu\.ph$/;
	return re.test(email);
  }
  
  function validatePassword(password) {
	// Password should be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character
	const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
	return re.test(password);
  }

  // Function to handle form submission
  function handleSubmit(event) {
	event.preventDefault(); // Prevent form submission
  
	// Get form values
	const email = document.getElementById('email').value;
	const password = document.getElementById('password').value;
  
	// Validate email and password
	if (!validateEmail(email)) {
	  alert('Invalid email format!');
	  return;
	}
  
	if (!validatePassword(password)) {
	  document.getElementById('passwordError').textContent = 'Invalid password! Password should be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.';
    return;
	}
  
	// If email and password are valid, proceed with login
	alert('Login successful!');
	// You can add code here to redirect the user to another page or perform other actions after successful login
  }

  function forgotPassword() {
	const email = prompt('Enter your email address to reset your password:');
	if (email && validateEmail(email)) {
	  alert('A password reset link has been sent to your email address. Please check your inbox.');
	  // You can add code here to send a password reset link to the provided email address
	} else {
	  alert('Invalid email format!');
	}
  }

  function togglePasswordVisibility() {
	const passwordInput = document.getElementById('password');
	const passwordToggle = document.querySelector('.password-toggle');
  
	if (passwordInput.type === 'password') {
	  passwordInput.type = 'text';
	  passwordToggle.innerHTML = '<i class="far fa-eye-slash"></i>';
	} else {
	  passwordInput.type = 'password';
	  passwordToggle.innerHTML = '<i class="far fa-eye"></i>';
	}
  }
  
  // Add event listener to the form submit button
  document.getElementById('loginForm').addEventListener('submit', handleSubmit);
  
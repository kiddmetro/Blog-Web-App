// // Display error message for 5 seconds and then hide
// setTimeout(function() {
//     var errorMessage = document.getElementById('error-message');
//     errorMessage.classList.add('hidden');
// }, 5000);




// function delayedSubmit(event) {
//     event.preventDefault(); // Prevent form submission

//     // Add your registration logic here (e.g., AJAX request)

//     // Delay for 2 seconds (2000 milliseconds)
//     setTimeout(function () {
//         // Show success popup
//         showSuccessPopup();

//         // Redirect to login page after 5 seconds (5000 milliseconds)
//         setTimeout(function () {
//             window.location.href = "login.html";
//         }, 5000);
//     }, 2000);
// }

// function showSuccessPopup() {
//     document.getElementById("successPopup").style.display = "block";
// }




// document.addEventListener("DOMContentLoaded", function () {
//     const signupForm = document.getElementById("signup-form");

//     if (signupForm) {
//         signupForm.addEventListener("submit", function delayedSubmit(event) {
//             document.getElementById("signup-form").addEventListener("submit", function delayedSubmit(event) {
//                 event.preventDefault(); // Prevent form submission
            
//                 // Add your registration logic here (e.g., AJAX request)
            
//                  // Delay for 2 seconds (2000 milliseconds)
//                  setTimeout(function () {
//                     // Show success popup
//                     showSuccessPopup();
            
//                     // Redirect to login page after 5 seconds (5000 milliseconds)
//                     setTimeout(function () {
//                         window.location.href = "login.html";
//                     }, 5000);
//                 }, 2000);
//             });
            
//             function showSuccessPopup() {
//                 document.getElementById("successPopup").style.display = "block";
//             }
            
//         });
//     } else {
//         console.error("Element with ID 'signupForm' not found");
//     }
// });

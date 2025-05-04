// This script manages the required attributes of the checkboxes in the job posting form
// It ensures that at least one checkbox is checked and sets the required attribute accordingly
// It also handles the case where both checkboxes are checked, allowing either to be unchecked
// to make the other one required
// This script is executed when the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    const checkboxPost = document.getElementById('jobAcceptMethodPost');
    const checkboxEmail = document.getElementById('jobAcceptMethodEmail');

    const updateRequiredAttributes = () => {
        if (checkboxPost.checked) {
            checkboxEmail.removeAttribute('required');
        } else {
            checkboxEmail.setAttribute('required', 'required');
        }

        if (checkboxEmail.checked) {
            checkboxPost.removeAttribute('required');
        } else {
            checkboxPost.setAttribute('required', 'required');
        }
    };

    checkboxPost.addEventListener('change', updateRequiredAttributes);
    checkboxEmail.addEventListener('change', updateRequiredAttributes);

    // Initial check on page load
    updateRequiredAttributes();
});
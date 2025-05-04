// This script is used to manage the job location dropdown in the job search form.
// It disables the first option when a user selects a different location and re-enables it when the user selects the first option again.
// It also ensures that the first option is always disabled when the page loads.
// This script is executed when the DOM content is fully loaded.
document.addEventListener('DOMContentLoaded', () => {
    const selectElement = document.getElementById('jobLocation');

    selectElement.addEventListener('change', () => {
        const firstOption = selectElement.options[0];

        if (selectElement.value === firstOption.value) {
            firstOption.setAttribute('disabled', 'disabled');
        } else {
            firstOption.removeAttribute('disabled');
        }
    });
});

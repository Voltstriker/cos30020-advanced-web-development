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

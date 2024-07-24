// js/multistep.js
document.addEventListener('DOMContentLoaded', () => {
    let currentStep = 0;
    const formSteps = document.querySelectorAll('.form-step');

    function showStep(step) {
        formSteps.forEach((formStep, index) => {
            formStep.classList.toggle('form-step-active', index === step);
        });
    }

    function validateStep(step) {
        const inputs = formSteps[step].querySelectorAll('input[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        return isValid;
    }

    window.nextStep = function() {
        if (validateStep(currentStep)) {
            if (currentStep < formSteps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        } else {
            alert('Please fill out all required fields.');
        }
    };

    window.prevStep = function() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    };

    showStep(currentStep);
});

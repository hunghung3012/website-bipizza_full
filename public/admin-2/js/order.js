document.addEventListener('DOMContentLoaded', function () {
    const cancelButton = document.querySelector('.cancel-button');
    const cancelQuestion = document.querySelector('.cancel_question');
    const cancelText = document.querySelector('.cancel_text');
    const removeButton = document.querySelector('.cancel_question .remove');
    const cancelDetailButton = document.querySelector('.cancel_detail');
    const backButton = document.querySelector('.back');
    const cancelButtonList = document.querySelectorAll('.cancel-button');

    // Loop through each .cancel-button element
    cancelButtonList.forEach(function(cancelButton) {
        // Add click event listener to each .cancel-button
        cancelButton.addEventListener('click', function () {
            // Find the corresponding .cancel_question and show it
            const cancelQuestion = cancelButton.nextElementSibling;
            if (cancelQuestion.classList.contains('cancel_question')) {
                cancelQuestion.style.display = 'block';
            }
        });
    });

    // Show cancel_question when cancel-button is clicked
    // cancelButton.addEventListener('click', function () {
    //     cancelQuestion.style.display = 'block';
    // });

    // Hide cancel_question and show cancel_text when cancel_detail is clicked
    cancelDetailButton.addEventListener('click', function () {
        cancelQuestion.style.display = 'none';
        cancelText.style.display = 'block';
    });

    // Hide cancel_text and show cancel_question when remove is clicked
    removeButton.addEventListener('click', function () {
        cancelQuestion.style.display = 'none';
       
    });

    // Hide cancel_text and show cancel_question when back is clicked
    backButton.addEventListener('click', function () {
        cancelQuestion.style.display = 'block';
        cancelText.style.display = 'none';
    });
});
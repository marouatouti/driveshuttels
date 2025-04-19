document.addEventListener('DOMContentLoaded', () => {
    const faqQuestions = document.querySelectorAll('.faq-question');
  
    faqQuestions.forEach(question => {
      question.addEventListener('click', () => {
        // Toggle active class on question
        question.classList.toggle('active');
        
        // Get the answer element
        const answer = question.nextElementSibling;
        
        // Toggle active class on answer
        answer.classList.toggle('active');
        
        // Close other answers
        faqQuestions.forEach(otherQuestion => {
          if (otherQuestion !== question) {
            otherQuestion.classList.remove('active');
            otherQuestion.nextElementSibling.classList.remove('active');
          }
        });
      });
    });
  });
  
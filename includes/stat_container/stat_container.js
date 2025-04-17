const observerOptions = {
    threshold: 0.5
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counterItems = entry.target.querySelectorAll('.pro-counter-item');
            counterItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('animate');
                    const numberElement = item.querySelector('.pro-counter-number');
                    animateCounter(numberElement);
                }, index * 200);
            });
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe the counter container
observer.observe(document.querySelector('.pro-counter-container'));

function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000; // Animation duration in milliseconds
    const steps = 50; // Number of steps in the animation
    const stepDuration = duration / steps;
    let current = 0;

    const increment = target / steps;

    const updateCounter = () => {
        current += increment;
        if (current < target) {
            element.textContent = Math.floor(current);
            setTimeout(updateCounter, stepDuration);
        } else {
            element.textContent = target;
        }
    };

    updateCounter();
}

// Add smooth reveal animation when scrolling
const counterItems = document.querySelectorAll('.pro-counter-item');
counterItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(20px)';
});

window.addEventListener('load', () => {
    counterItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
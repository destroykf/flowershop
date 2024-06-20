const boxContainer = document.querySelector('.products .box-container');
    const boxes = document.querySelectorAll('.products .box');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    let currentIndex = 0;

    function showBox(index) {
        const offset = -index * 100; // Рассчитать смещение на основе ширины одного товара (100%)
        boxContainer.style.transform = `translateX(${offset}%)`;
    }

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            showBox(currentIndex);
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentIndex < boxes.length - 1) {
            currentIndex++;
            showBox(currentIndex);
        }
    });
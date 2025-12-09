export default function graphicsMove() { 

    // Find any container that holds dots or graphic
    const sections = new Set();

    document.querySelectorAll('.dots-blue, .graphic-blue').forEach(el => {
        sections.add(el.closest('section, div')); 
        // You can adjust which parent to use if needed
    });

    // Convert Set to array and remove nulls
    const validSections = [...sections].filter(Boolean);

    if (!validSections.length) return;

    validSections.forEach(section => {

        const dots = section.querySelector('.dots-blue');
        const graphic = section.querySelector('.graphic-blue');

        let active = false;

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                active = entry.isIntersecting;
            });
        }, { threshold: 0.2 });

        observer.observe(section);

        window.addEventListener('scroll', () => {
            if (!active) return;

            const rect = section.getBoundingClientRect();
            const progress = 1 - (rect.top / window.innerHeight); // normalized 0 to 1

            if (dots) {
                dots.style.transform = `translateY(${progress * 40}px)`;
            }

            if (graphic) {
                graphic.style.transform = `translateY(${progress * -40}px)`;
            }
        });

    });
}
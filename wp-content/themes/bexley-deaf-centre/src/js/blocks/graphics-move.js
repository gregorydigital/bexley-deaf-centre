export default function graphicsMove() { 

    const section = document.querySelector('.fifty-fifty__right');
  
    if(section) {
        
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
    }
}

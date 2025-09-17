import {Controller} from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['alerts'];

    connect() {
        this.initAlerts();

        document.addEventListener('init-alert', (e) => {
            this.initAlerts();
        });
    }

    initAlerts() {
        const alertDuration = 6000;

        this.alertsTargets.forEach((alert) => {
            setTimeout(() => {
                const progressBar = alert.querySelector('progress');
                const maxValue = progressBar.max;
                const startTime = Date.now();

                const timer = setInterval(() => {
                    const elapsedTime = Date.now() - startTime;
                    progressBar.value = Math.max(0, maxValue - (maxValue * elapsedTime) / alertDuration);

                    if (elapsedTime >= alertDuration) {
                        clearInterval(timer);
                        alert.remove();
                    }
                }, 10);
            }, 1000); // Temps avant que la progress bar commence a diminuer après l'apparition de l'alerte
        })
    }

    close(event) {
        let target = event.target.closest('.alert-close');
        let alert = target.closest('.alert');
        let id = alert.getAttribute('id');
        this.alertsTargets.forEach((alert) => {
            alert.remove();
        });
    }
}
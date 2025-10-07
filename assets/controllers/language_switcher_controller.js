import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static values = {
        apiUrl: String
    }

    // Gérer la sélection d'une langue
    async selectLanguage(event) {
        event.preventDefault()

        const selectedLocale = event.currentTarget.dataset.locale

        // Appeler la route de changement de langue
        await this.setLocaleOnServer(selectedLocale)
    }

    // Envoyer la locale au serveur
    async setLocaleOnServer(locale) {
        try {
            const response = await fetch(this.apiUrlValue, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ locale: locale })
            })

            if (response.ok) {
                // Recharger la page pour appliquer les traductions
                window.location.reload()
            } else {
                console.error('Erreur lors de la définition de la locale:', response.statusText)
            }
        } catch (error) {
            console.error('Erreur lors de la définition de la locale:', error)
        }
    }
}

<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ref } from 'vue';

const openFaq = ref(null);

const toggleFaq = (index) => {
    openFaq.value = openFaq.value === index ? null : index;
};

const faqs = [
    {
        question: 'Comment créer un compte ?',
        answer: 'Cliquez sur "Inscription" en haut à droite, remplissez le formulaire avec votre nom, email et mot de passe. Vous recevrez un email de confirmation pour activer votre compte.'
    },
    {
        question: 'Comment ajouter un véhicule ?',
        answer: 'Une fois connecté, allez dans votre tableau de bord et cliquez sur "Ajouter un véhicule". Renseignez les informations de votre véhicule (marque, modèle, immatriculation) et les dates d\'échéance de votre assurance et visite technique.'
    },
    {
        question: 'Quels types de rappels vais-je recevoir ?',
        answer: 'Vous recevrez des rappels automatiques pour le renouvellement de votre assurance, la visite technique, et toute autre échéance que vous aurez configurée. Les rappels sont envoyés 14 jours, 7 jours et 2 jours avant l\'échéance.'
    },
    {
        question: 'Par quels moyens vais-je recevoir les notifications ?',
        answer: 'Les notifications sont envoyées par SMS, email et WhatsApp selon vos préférences. Vous pouvez configurer les canaux de notification dans les paramètres de votre compte.'
    },
    {
        question: 'Comment effectuer un paiement ?',
        answer: 'Lorsqu\'un paiement est nécessaire, cliquez sur "Payer" depuis votre tableau de bord. Vous serez redirigé vers notre partenaire de paiement sécurisé (KkiaPay ou FedaPay) pour finaliser la transaction.'
    },
    {
        question: 'Les paiements sont-ils sécurisés ?',
        answer: 'Oui, tous les paiements sont traités par nos partenaires agréés (KkiaPay et FedaPay) qui utilisent des protocoles de sécurité bancaire. Nous ne stockons jamais vos informations de carte bancaire.'
    },
    {
        question: 'Puis-je gérer plusieurs véhicules ?',
        answer: 'Oui, vous pouvez ajouter autant de véhicules que vous le souhaitez dans votre compte. Chaque véhicule aura ses propres rappels et échéances.'
    },
    {
        question: 'Comment modifier les informations de mon véhicule ?',
        answer: 'Allez dans votre tableau de bord, sélectionnez le véhicule à modifier, puis cliquez sur "Modifier". Vous pourrez mettre à jour toutes les informations et dates d\'échéance.'
    },
    {
        question: 'Que faire si je ne reçois pas les notifications ?',
        answer: 'Vérifiez que votre numéro de téléphone et email sont corrects dans votre profil. Vérifiez également vos dossiers spam/courrier indésirable. Si le problème persiste, contactez notre support.'
    },
    {
        question: 'Comment fonctionne le parrainage ?',
        answer: 'Vous recevez un code de parrainage unique dans votre tableau de bord. Partagez-le avec vos proches. Lorsqu\'ils s\'inscrivent avec votre code et effectuent leur premier paiement, vous recevez un bonus de 5000 FCFA.'
    },
    {
        question: 'Puis-je annuler mon compte ?',
        answer: 'Oui, vous pouvez supprimer votre compte à tout moment depuis les paramètres. Toutes vos données seront effacées sous 30 jours conformément à notre politique de confidentialité.'
    },
    {
        question: 'Comment contacter le support ?',
        answer: 'Vous pouvez nous contacter par email à support@eautogestion.bj ou par téléphone au +229 97 00 00 00. Notre équipe est disponible du lundi au vendredi de 8h à 18h et le samedi de 9h à 13h.'
    }
];

const categories = [
    {
        icon: '🚗',
        title: 'Gestion des véhicules',
        description: 'Apprenez à ajouter et gérer vos véhicules'
    },
    {
        icon: '🔔',
        title: 'Notifications',
        description: 'Configuration et gestion des rappels'
    },
    {
        icon: '💳',
        title: 'Paiements',
        description: 'Tout sur les paiements sécurisés'
    },
    {
        icon: '👤',
        title: 'Mon compte',
        description: 'Gérez votre profil et paramètres'
    }
];
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <section class="bg-green-700 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                    Centre d'aide
                </h1>
                <p class="text-xl text-green-100">
                    Trouvez rapidement des réponses à vos questions
                </p>
            </div>
        </section>

        <!-- Quick Links -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        v-for="category in categories"
                        :key="category.title"
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition cursor-pointer"
                    >
                        <div class="text-4xl mb-3">{{ category.icon }}</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ category.title }}</h3>
                        <p class="text-gray-600 text-sm">{{ category.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                    Questions fréquentes
                </h2>

                <div class="space-y-4">
                    <div
                        v-for="(faq, index) in faqs"
                        :key="index"
                        class="bg-white rounded-lg shadow-sm overflow-hidden"
                    >
                        <button
                            @click="toggleFaq(index)"
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition"
                        >
                            <span class="font-semibold text-gray-900">{{ faq.question }}</span>
                            <svg
                                class="w-5 h-5 text-gray-500 transform transition-transform"
                                :class="{ 'rotate-180': openFaq === index }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            v-show="openFaq === index"
                            class="px-6 py-4 bg-gray-50 border-t border-gray-100"
                        >
                            <p class="text-gray-600">{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Getting Started Guide -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                    Guide de démarrage rapide
                </h2>

                <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold">
                                1
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Créez votre compte</h3>
                            <p class="text-gray-600">
                                Inscrivez-vous gratuitement en quelques secondes avec votre email. Vous recevrez un lien de confirmation pour activer votre compte.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold">
                                2
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Ajoutez vos véhicules</h3>
                            <p class="text-gray-600">
                                Depuis votre tableau de bord, cliquez sur "Ajouter un véhicule" et renseignez les informations : marque, modèle, immatriculation, dates d'échéance d'assurance et de visite technique.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold">
                                3
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Configurez vos notifications</h3>
                            <p class="text-gray-600">
                                Choisissez comment vous souhaitez recevoir vos rappels : SMS, email, WhatsApp ou tous les canaux. Vous pouvez modifier ces préférences à tout moment.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold">
                                4
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Recevez vos rappels automatiquement</h3>
                            <p class="text-gray-600">
                                E-Auto Gestion vous enverra des notifications 14 jours, 7 jours et 2 jours avant chaque échéance. Vous ne manquerez plus jamais un renouvellement !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Support -->
        <section class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Vous ne trouvez pas la réponse ?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Notre équipe de support est là pour vous aider
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a
                        href="/contact"
                        class="inline-flex items-center justify-center bg-green-700 text-white hover:bg-green-800 px-6 py-3 rounded-lg font-semibold transition"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Nous contacter
                    </a>
                    <a
                        href="tel:+22997000000"
                        class="inline-flex items-center justify-center bg-white text-green-700 border-2 border-green-700 hover:bg-green-50 px-6 py-3 rounded-lg font-semibold transition"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +229 97 00 00 00
                    </a>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

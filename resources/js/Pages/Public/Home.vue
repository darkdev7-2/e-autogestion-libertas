<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';

const features = [
    {
        icon: '🔔',
        title: 'Notifications automatiques',
        description: 'Recevez des rappels par SMS, Email et WhatsApp pour vos échéances d\'assurance et visite technique.'
    },
    {
        icon: '💳',
        title: 'Paiements en ligne',
        description: 'Payez vos services en toute sécurité via KkiaPay ou FedaPay directement depuis la plateforme.'
    },
    {
        icon: '📊',
        title: 'Tableau de bord intuitif',
        description: 'Suivez tous vos véhicules et leurs échéances administratives en un seul endroit.'
    },
    {
        icon: '🌍',
        title: 'Multilingue',
        description: 'Interface disponible en Français et Anglais pour votre confort.'
    },
    {
        icon: '🚗',
        title: 'Gestion multi-véhicules',
        description: 'Gérez plusieurs véhicules avec un seul compte, idéal pour les professionnels.'
    },
    {
        icon: '🎁',
        title: 'Programme de parrainage',
        description: 'Parrainez vos proches et bénéficiez de bonus sur vos prochains paiements.'
    }
];

const steps = [
    {
        number: '1',
        title: 'Inscription',
        description: 'Créez votre compte gratuitement en quelques secondes.'
    },
    {
        number: '2',
        title: 'Ajoutez vos véhicules',
        description: 'Enregistrez vos véhicules et leurs informations administratives.'
    },
    {
        number: '3',
        title: 'Recevez des rappels',
        description: 'Soyez alerté automatiquement avant chaque échéance.'
    },
    {
        number: '4',
        title: 'Payez en ligne',
        description: 'Effectuez vos paiements directement depuis la plateforme.'
    }
];
</script>

<template>
    <PublicLayout>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-green-700 to-green-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-32">
                <div class="text-center">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
                        Gérez vos véhicules en toute sérénité
                    </h1>
                    <p class="text-xl sm:text-2xl mb-8 text-green-100 max-w-3xl mx-auto">
                        E-Auto Gestion simplifie la gestion administrative de vos véhicules au Bénin avec des rappels automatiques et des paiements en ligne.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            href="/register"
                            class="bg-white text-green-700 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-semibold transition shadow-lg"
                        >
                            Commencer gratuitement
                        </Link>
                        <Link
                            href="/contact"
                            class="bg-green-800 text-white hover:bg-green-900 px-8 py-4 rounded-lg text-lg font-semibold transition"
                        >
                            Nous contacter
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Pourquoi choisir E-Auto Gestion ?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Une solution complète pour ne plus jamais oublier une échéance administrative.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="feature in features"
                        :key="feature.title"
                        class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition"
                    >
                        <div class="text-4xl mb-4">{{ feature.icon }}</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ feature.title }}</h3>
                        <p class="text-gray-600">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Comment ça marche ?
                    </h2>
                    <p class="text-xl text-gray-600">
                        En 4 étapes simples, commencez à gérer vos véhicules efficacement.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        v-for="step in steps"
                        :key="step.number"
                        class="text-center"
                    >
                        <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            {{ step.number }}
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ step.title }}</h3>
                        <p class="text-gray-600">{{ step.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 bg-green-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-5xl font-bold mb-2">95%</div>
                        <p class="text-green-100">Réduction des oublis</p>
                    </div>
                    <div>
                        <div class="text-5xl font-bold mb-2">24/7</div>
                        <p class="text-green-100">Support disponible</p>
                    </div>
                    <div>
                        <div class="text-5xl font-bold mb-2">100%</div>
                        <p class="text-green-100">Sécurisé</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    Prêt à simplifier la gestion de vos véhicules ?
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Rejoignez des centaines de Béninois qui font confiance à E-Auto Gestion.
                </p>
                <Link
                    href="/register"
                    class="inline-block bg-green-700 text-white hover:bg-green-800 px-8 py-4 rounded-lg text-lg font-semibold transition shadow-lg"
                >
                    Créer mon compte gratuitement
                </Link>
            </div>
        </section>
    </PublicLayout>
</template>

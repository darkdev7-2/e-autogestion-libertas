<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <section class="bg-green-700 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                    Mentions Légales
                </h1>
                <p class="text-xl text-green-100">
                    Informations légales et conditions d'utilisation
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
                    <!-- Editeur -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Éditeur du site</h2>
                        <div class="text-gray-600 space-y-2">
                            <p><strong>Nom :</strong> E-Auto Gestion</p>
                            <p><strong>Adresse :</strong> Cotonou, Bénin</p>
                            <p><strong>Email :</strong> support@eautogestion.bj</p>
                            <p><strong>Téléphone :</strong> +229 97 00 00 00</p>
                        </div>
                    </div>

                    <!-- Hebergement -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Hébergement</h2>
                        <p class="text-gray-600">
                            Le site est hébergé sur des serveurs sécurisés conformes aux normes internationales de sécurité des données.
                        </p>
                    </div>

                    <!-- Propriete Intellectuelle -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Propriété intellectuelle</h2>
                        <p class="text-gray-600 mb-4">
                            L'ensemble du contenu de ce site (textes, images, logos, graphismes, etc.) est la propriété exclusive d'E-Auto Gestion. Toute reproduction, même partielle, est strictement interdite sans autorisation préalable écrite.
                        </p>
                        <p class="text-gray-600">
                            Les marques et logos présents sur ce site sont déposés par E-Auto Gestion. Toute reproduction ou utilisation non autorisée constitue une contrefaçon.
                        </p>
                    </div>

                    <!-- CGU -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Conditions générales d'utilisation</h2>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">4.1. Acceptation des conditions</h3>
                        <p class="text-gray-600 mb-4">
                            En utilisant E-Auto Gestion, vous acceptez sans réserve les présentes conditions générales d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser nos services.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">4.2. Services proposés</h3>
                        <p class="text-gray-600 mb-4">E-Auto Gestion propose les services suivants :</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Gestion des informations administratives des véhicules</li>
                            <li>Envoi de rappels automatiques par SMS, email et WhatsApp</li>
                            <li>Traitement des paiements en ligne via nos partenaires</li>
                            <li>Suivi des échéances (assurance, visite technique, etc.)</li>
                        </ul>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">4.3. Compte utilisateur</h3>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Vous devez créer un compte pour utiliser nos services</li>
                            <li>Vous êtes responsable de la confidentialité de vos identifiants</li>
                            <li>Les informations fournies doivent être exactes et à jour</li>
                            <li>Un compte ne peut être utilisé que par une seule personne</li>
                        </ul>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">4.4. Tarification</h3>
                        <p class="text-gray-600">
                            L'utilisation de base d'E-Auto Gestion est gratuite. Des frais peuvent s'appliquer pour certains services premium ou transactions. Les tarifs sont clairement indiqués avant tout engagement.
                        </p>
                    </div>

                    <!-- Responsabilites -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Responsabilités</h2>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">5.1. Responsabilité de l'utilisateur</h3>
                        <p class="text-gray-600 mb-4">L'utilisateur s'engage à :</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Fournir des informations exactes et à jour</li>
                            <li>Utiliser le service de manière conforme à la loi</li>
                            <li>Ne pas tenter de perturber le fonctionnement du site</li>
                            <li>Respecter les droits d'autrui</li>
                        </ul>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">5.2. Responsabilité d'E-Auto Gestion</h3>
                        <p class="text-gray-600 mb-4">
                            E-Auto Gestion s'efforce de fournir un service de qualité mais ne peut garantir :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>La disponibilité permanente du service (maintenance, pannes)</li>
                            <li>L'exactitude absolue des informations fournies</li>
                            <li>L'absence d'erreurs ou de bugs</li>
                        </ul>
                        <p class="text-gray-600 mt-4">
                            E-Auto Gestion ne pourra être tenu responsable en cas de perte de données due à un cas de force majeure, à un problème technique indépendant de notre volonté, ou à une mauvaise utilisation de nos services.
                        </p>
                    </div>

                    <!-- Protection des donnees -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Protection des données</h2>
                        <p class="text-gray-600">
                            Le traitement des données personnelles est conforme au RGPD et aux lois béninoises en vigueur. Pour plus d'informations, consultez notre
                            <a href="/confidentialite" class="text-green-700 hover:text-green-800 underline">Politique de Confidentialité</a>.
                        </p>
                    </div>

                    <!-- Cookies -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies</h2>
                        <p class="text-gray-600">
                            Ce site utilise des cookies nécessaires à son fonctionnement (authentification, préférences). En continuant à naviguer, vous acceptez leur utilisation.
                        </p>
                    </div>

                    <!-- Droit applicable -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Droit applicable et juridiction</h2>
                        <p class="text-gray-600">
                            Les présentes mentions légales sont régies par le droit béninois. Tout litige relève de la compétence exclusive des tribunaux de Cotonou, Bénin.
                        </p>
                    </div>

                    <!-- Modifications -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Modifications</h2>
                        <p class="text-gray-600">
                            E-Auto Gestion se réserve le droit de modifier les présentes mentions légales à tout moment. Les modifications entrent en vigueur dès leur publication sur le site.
                        </p>
                    </div>

                    <!-- Contact -->
                    <div class="bg-green-50 p-6 rounded-lg mt-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Contact</h2>
                        <p class="text-gray-600 mb-4">
                            Pour toute question concernant ces mentions légales :
                        </p>
                        <ul class="text-gray-600 space-y-2">
                            <li><strong>Email :</strong> support@eautogestion.bj</li>
                            <li><strong>Téléphone :</strong> +229 97 00 00 00</li>
                            <li><strong>Adresse :</strong> Cotonou, Bénin</li>
                        </ul>
                    </div>

                    <p class="text-sm text-gray-500 text-center mt-8">
                        Dernière mise à jour : Janvier 2025
                    </p>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

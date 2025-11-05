<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <section class="bg-green-700 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                    Politique de Confidentialité
                </h1>
                <p class="text-xl text-green-100">
                    Dernière mise à jour : Janvier 2025
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="prose prose-lg max-w-none">
                    <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
                        <!-- Introduction -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
                            <p class="text-gray-600">
                                E-Auto Gestion s'engage à protéger la vie privée de ses utilisateurs. Cette politique de confidentialité décrit comment nous collectons, utilisons et protégeons vos informations personnelles.
                            </p>
                        </div>

                        <!-- Information Collected -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Informations collectées</h2>
                            <p class="text-gray-600 mb-4">Nous collectons les informations suivantes :</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Informations d'identification : nom, prénom, email, numéro de téléphone</li>
                                <li>Informations sur vos véhicules : marque, modèle, immatriculation, dates d'échéance</li>
                                <li>Informations de paiement : transactions effectuées via nos partenaires (KkiaPay, FedaPay)</li>
                                <li>Données de navigation : adresse IP, type de navigateur, pages visitées</li>
                            </ul>
                        </div>

                        <!-- Use of Information -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Utilisation des informations</h2>
                            <p class="text-gray-600 mb-4">Vos informations sont utilisées pour :</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Gérer votre compte et vos véhicules</li>
                                <li>Envoyer des rappels d'échéances par SMS, email et WhatsApp</li>
                                <li>Traiter vos paiements de manière sécurisée</li>
                                <li>Améliorer nos services et votre expérience utilisateur</li>
                                <li>Vous contacter concernant votre compte ou nos services</li>
                            </ul>
                        </div>

                        <!-- Data Protection -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Protection des données</h2>
                            <p class="text-gray-600 mb-4">
                                Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos informations :
                            </p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Chiffrement SSL/TLS pour toutes les communications</li>
                                <li>Stockage sécurisé des mots de passe (hachage bcrypt)</li>
                                <li>Accès restreint aux données personnelles</li>
                                <li>Sauvegardes régulières et sécurisées</li>
                                <li>Conformité aux normes de sécurité des paiements</li>
                            </ul>
                        </div>

                        <!-- Data Sharing -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Partage des informations</h2>
                            <p class="text-gray-600 mb-4">
                                Nous ne vendons jamais vos données personnelles. Nous pouvons partager vos informations uniquement avec :
                            </p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Nos partenaires de paiement (KkiaPay, FedaPay) pour traiter les transactions</li>
                                <li>Nos fournisseurs de services (Twilio, SendGrid) pour les notifications</li>
                                <li>Les autorités légales si requis par la loi</li>
                            </ul>
                        </div>

                        <!-- Your Rights -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Vos droits</h2>
                            <p class="text-gray-600 mb-4">Vous avez le droit de :</p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Accéder à vos données personnelles</li>
                                <li>Rectifier vos informations</li>
                                <li>Supprimer votre compte et vos données</li>
                                <li>Vous opposer au traitement de vos données</li>
                                <li>Exporter vos données dans un format lisible</li>
                            </ul>
                            <p class="text-gray-600 mt-4">
                                Pour exercer ces droits, contactez-nous à : support@eautogestion.bj
                            </p>
                        </div>

                        <!-- Cookies -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies</h2>
                            <p class="text-gray-600">
                                Nous utilisons des cookies essentiels pour le fonctionnement du site (authentification, préférences). Vous pouvez désactiver les cookies dans les paramètres de votre navigateur, mais cela peut affecter certaines fonctionnalités.
                            </p>
                        </div>

                        <!-- Data Retention -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Conservation des données</h2>
                            <p class="text-gray-600">
                                Nous conservons vos données aussi longtemps que votre compte est actif. Après suppression de votre compte, vos données sont effacées sous 30 jours, sauf obligation légale de conservation.
                            </p>
                        </div>

                        <!-- Changes -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Modifications</h2>
                            <p class="text-gray-600">
                                Nous pouvons modifier cette politique de confidentialité à tout moment. Les changements seront publiés sur cette page avec une nouvelle date de mise à jour. Nous vous encourageons à consulter régulièrement cette page.
                            </p>
                        </div>

                        <!-- Contact -->
                        <div class="bg-green-50 p-6 rounded-lg mt-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Contact</h2>
                            <p class="text-gray-600 mb-4">
                                Pour toute question concernant cette politique de confidentialité :
                            </p>
                            <ul class="text-gray-600 space-y-2">
                                <li><strong>Email :</strong> support@eautogestion.bj</li>
                                <li><strong>Téléphone :</strong> +229 97 00 00 00</li>
                                <li><strong>Adresse :</strong> Cotonou, Bénin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

<style scoped>
.prose h2 {
    margin-top: 0;
}
</style>

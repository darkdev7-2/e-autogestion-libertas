<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Accueil', href: '/' },
    { name: 'Contact', href: '/contact' },
    { name: 'Aide', href: '/aide' },
];
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <Link href="/" class="flex items-center">
                            <span class="text-2xl font-bold text-green-700">E-Auto Gestion</span>
                        </Link>

                        <!-- Desktop Navigation -->
                        <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                            <Link
                                v-for="item in navigation"
                                :key="item.name"
                                :href="item.href"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 hover:text-green-700 transition"
                                :class="{ 'border-b-2 border-green-700': $page.url === item.href }"
                            >
                                {{ item.name }}
                            </Link>
                        </div>
                    </div>

                    <!-- Auth Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                        <Link
                            v-if="!$page.props.auth.user"
                            href="/login"
                            class="text-gray-700 hover:text-green-700 px-3 py-2 text-sm font-medium transition"
                        >
                            Connexion
                        </Link>
                        <Link
                            v-if="!$page.props.auth.user"
                            href="/register"
                            class="bg-green-700 text-white hover:bg-green-800 px-4 py-2 rounded-lg text-sm font-medium transition"
                        >
                            Inscription
                        </Link>
                        <Link
                            v-if="$page.props.auth.user"
                            href="/dashboard"
                            class="bg-green-700 text-white hover:bg-green-800 px-4 py-2 rounded-lg text-sm font-medium transition"
                        >
                            Tableau de bord
                        </Link>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div v-show="mobileMenuOpen" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-green-700"
                    >
                        {{ item.name }}
                    </Link>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="space-y-1">
                        <Link
                            v-if="!$page.props.auth.user"
                            href="/login"
                            class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Connexion
                        </Link>
                        <Link
                            v-if="!$page.props.auth.user"
                            href="/register"
                            class="block pl-3 pr-4 py-2 text-base font-medium text-green-700 hover:bg-gray-50"
                        >
                            Inscription
                        </Link>
                        <Link
                            v-if="$page.props.auth.user"
                            href="/dashboard"
                            class="block pl-3 pr-4 py-2 text-base font-medium text-green-700 hover:bg-gray-50"
                        >
                            Tableau de bord
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- About -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">E-Auto Gestion</h3>
                        <p class="text-gray-400 text-sm">
                            Votre solution de gestion administrative pour véhicules au Bénin.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                        <ul class="space-y-2">
                            <li>
                                <Link href="/" class="text-gray-400 hover:text-white text-sm transition">
                                    Accueil
                                </Link>
                            </li>
                            <li>
                                <Link href="/aide" class="text-gray-400 hover:text-white text-sm transition">
                                    Aide
                                </Link>
                            </li>
                            <li>
                                <Link href="/contact" class="text-gray-400 hover:text-white text-sm transition">
                                    Contact
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Légal</h3>
                        <ul class="space-y-2">
                            <li>
                                <Link href="/confidentialite" class="text-gray-400 hover:text-white text-sm transition">
                                    Confidentialité
                                </Link>
                            </li>
                            <li>
                                <Link href="/mentions-legales" class="text-gray-400 hover:text-white text-sm transition">
                                    Mentions légales
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li>Email: support@eautogestion.bj</li>
                            <li>Tél: +229 97 00 00 00</li>
                            <li>Cotonou, Bénin</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                    <p>&copy; {{ new Date().getFullYear() }} E-Auto Gestion. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

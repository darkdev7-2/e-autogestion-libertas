<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Reminder;
use App\Models\Payment;
use App\Models\ServiceRequest;
use App\Models\Referral;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Administrateur',
            'email' => 'super@eautogestion.bj',
            'phone' => '+22997000001',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'locale' => 'fr',
            'status' => 'active',
        ]);
        $superAdmin->assignRole('super_admin');

        // Create Admin
        $admin = User::create([
            'name' => 'Jean-Baptiste Admin',
            'email' => 'admin@eautogestion.bj',
            'phone' => '+22997000002',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'locale' => 'fr',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        // Create Agent
        $agent = User::create([
            'name' => 'Marie Agent',
            'email' => 'agent@eautogestion.bj',
            'phone' => '+22997000003',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'locale' => 'fr',
            'status' => 'active',
        ]);
        $agent->assignRole('agent');

        // Create Test Clients with Vehicles and Reminders
        $clientsData = [
            [
                'name' => 'Kouassi Pierre',
                'email' => 'pierre.kouassi@example.bj',
                'phone' => '+22997111111',
                'address' => 'Quartier Cadjèhoun, Cotonou',
                'city' => 'Cotonou',
                'vehicles' => [
                    [
                        'brand' => 'Toyota',
                        'model' => 'Corolla',
                        'registration_number' => 'AB-1234-BJ',
                        'insurance_expiry' => now()->addDays(30),
                        'inspection_due_at' => now()->addDays(45),
                    ],
                ],
            ],
            [
                'name' => 'Aïcha Dossou',
                'email' => 'aicha.dossou@example.bj',
                'phone' => '+22997222222',
                'address' => 'Zone Résidentielle, Porto-Novo',
                'city' => 'Porto-Novo',
                'vehicles' => [
                    [
                        'brand' => 'Honda',
                        'model' => 'Civic',
                        'registration_number' => 'CD-5678-BJ',
                        'insurance_expiry' => now()->addDays(10),
                        'inspection_due_at' => now()->addDays(60),
                    ],
                    [
                        'brand' => 'Mercedes-Benz',
                        'model' => 'C-Class',
                        'registration_number' => 'EF-9012-BJ',
                        'insurance_expiry' => now()->addDays(90),
                        'inspection_due_at' => now()->addDays(120),
                    ],
                ],
            ],
            [
                'name' => 'Thomas Agossou',
                'email' => 'thomas.agossou@example.bj',
                'phone' => '+22997333333',
                'address' => 'Rue des Cocotiers, Parakou',
                'city' => 'Parakou',
                'vehicles' => [
                    [
                        'brand' => 'Peugeot',
                        'model' => '508',
                        'registration_number' => 'GH-3456-BJ',
                        'insurance_expiry' => now()->subDays(5),
                        'inspection_due_at' => now()->addDays(20),
                    ],
                ],
            ],
        ];

        foreach ($clientsData as $clientData) {
            // Create user
            $user = User::create([
                'name' => $clientData['name'],
                'email' => $clientData['email'],
                'phone' => $clientData['phone'],
                'password' => Hash::make('password'),
                'role' => 'client',
                'locale' => 'fr',
                'status' => 'active',
            ]);
            $user->assignRole('client');

            // Create client profile
            $client = Client::create([
                'user_id' => $user->id,
                'address' => $clientData['address'],
                'city' => $clientData['city'],
                'notes' => 'Client créé lors du seeding',
            ]);

            // Create vehicles and reminders
            foreach ($clientData['vehicles'] as $vehicleData) {
                $vehicle = Vehicle::create([
                    'client_id' => $client->id,
                    'brand' => $vehicleData['brand'],
                    'model' => $vehicleData['model'],
                    'registration_number' => $vehicleData['registration_number'],
                    'insurance_expiry' => $vehicleData['insurance_expiry'],
                    'inspection_due_at' => $vehicleData['inspection_due_at'],
                ]);

                // Create insurance reminder
                Reminder::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'insurance',
                    'due_at' => $vehicleData['insurance_expiry'],
                    'status' => $vehicleData['insurance_expiry']->isPast() ? 'late' : 'pending',
                    'notes' => 'Renouvellement assurance',
                ]);

                // Create inspection reminder
                Reminder::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'inspection',
                    'due_at' => $vehicleData['inspection_due_at'],
                    'status' => 'pending',
                    'notes' => 'Visite technique',
                ]);
            }

            // Create a payment for the first user
            if ($user->id === 4) {
                Payment::create([
                    'user_id' => $user->id,
                    'amount' => 45000,
                    'provider' => 'kkiapay',
                    'transaction_id' => 'KKPY' . str_pad($user->id, 10, '0', STR_PAD_LEFT),
                    'status' => 'paid',
                    'paid_at' => now()->subDays(5),
                    'description' => 'Paiement assurance Toyota Corolla',
                ]);
            }

            // Create a service request
            if ($user->id === 5) {
                ServiceRequest::create([
                    'user_id' => $user->id,
                    'vehicle_id' => Vehicle::where('client_id', $client->id)->first()->id,
                    'type' => 'inspection',
                    'status' => 'pending',
                    'description' => 'Demande de visite technique pour Honda Civic',
                ]);
            }

            // Create referral code for each client
            Referral::create([
                'user_id' => $user->id,
                'bonus_cfa' => 0,
                'status' => 'pending',
            ]);
        }

        // Create some settings
        Setting::setValue('app_name', 'E-Auto Gestion', 'Nom de l\'application');
        Setting::setValue('reminder_days', [14, 7, 2], 'Jours avant échéance pour envoyer les rappels');
        Setting::setValue('referral_bonus', 5000, 'Bonus de parrainage en FCFA');
        Setting::setValue('payment_methods', ['kkiapay', 'fedapay'], 'Méthodes de paiement disponibles');
        Setting::setValue('notification_channels', ['sms', 'email', 'whatsapp'], 'Canaux de notification disponibles');
        Setting::setValue('support_email', 'support@eautogestion.bj', 'Email de support');
        Setting::setValue('support_phone', '+22997000000', 'Téléphone de support');
    }
}

<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'Laravel'),

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    'timezone' => 'UTC',

    'locale' => 'en',


    'fallback_locale' => 'en',

    'faker_locale' => 'en_US',

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],



    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        Spatie\Permission\PermissionServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

    'permissions' => [
        [
            'name' => 'a.users',
            'menu' => 'Gestion de Usuarios',
        ],
        [
            'name' => 'a.institutional',
            'menu' => 'Hospital',
        ],
        [
            'name' => 'a.workers',
            'menu' => 'Getion del personal',
        ],
        [
            'name' => 'a.sliders',
            'menu' => 'Slider',
        ],
        [
            'name' => 'a.final-services',
            'menu' => 'Servicios finales',
        ],
        [
            'name' => 'a.intermediate-services',
            'menu' => 'Servicios intermedios',
        ],
        [
            'name' => 'a.offices',
            'menu' => 'Oficinas',
        ],
        [
            'name' => 'a.service-portfolios',
            'menu' => 'Cartera de servicios',
        ],
        [
            'name' => 'a.guidance-documents',
            'menu' => 'Documentos guiás',
        ],
        [
            'name' => 'a.announcements',
            'menu' => 'Convocatorias',
        ],
        [
            'name' => 'a.purchase-and-service',
            'menu' => 'Compra y servicio',
        ],
        [
            'name' => 'a.news',
            'menu' => 'Getion de noticias',
        ],
        [
            'name' => 'a.publications',
            'menu' => 'Getion de publicaciones',
        ],
        [
            'name' => 'a.events',
            'menu' => 'Gestion de campañas y eventos',
        ],
        [
            'name' => 'a.supporting-services',
            'menu' => 'Servicios de apoyo',
        ],
        [
            'name' => 'a.specialties',
            'menu' => 'Especialidades',
        ],
        [
            'name' => 'a.areas',
            'menu' => 'Areas',
        ],
    ],


    //path: /assets/icons/office
    'officeFigures' => [
        [
            'name' => 'Achievement.svg',
            'description' => 'Figura Logro',
        ],
        [
            'name' => 'Agenda.svg',
            'description' => 'Figura Agenda',
        ],
        [
            'name' => 'Application.svg',
            'description' => 'Figura Aplicacion',
        ],
        [
            'name' => 'Balance.svg',
            'description' => 'Figura Balance',
        ],
        [
            'name' => 'Best Employee.svg',
            'description' => 'Figura Mejor empleado',
        ],
        [
            'name' => 'Best Employee_1.svg',
            'description' => 'Figura Mejor empleado 1',
        ],
        [
            'name' => 'Campaign.svg',
            'description' => 'Figura Campaña',
        ],
        [
            'name' => 'Career.svg',
            'description' => 'Figura Carrera',
        ],
        [
            'name' => 'CEO.svg',
            'description' => 'Figura CEO',
        ],
        [
            'name' => 'Coffee Break.svg',
            'description' => 'Figura Pausa para el cafe',
        ],
        [
            'name' => 'Conference.svg',
            'description' => 'Figura Conferencia',
        ],
        [
            'name' => 'Copy Machine.svg',
            'description' => 'Figura Maquina de copia',
        ],
        [
            'name' => 'Creative Idea.svg',
            'description' => 'Figura Creativo',
        ],
        [
            'name' => 'Crowdfunding.svg',
            'description' => 'Figura Crowdfunding',
        ],
        [
            'name' => 'Employee.svg',
            'description' => 'Figura Empleado',
        ],
        [
            'name' => 'Exchange.svg',
            'description' => 'Figura Intercambio',
        ],
        [
            'name' => 'Expantion.svg',
            'description' => 'Figura Expansión',
        ],
        [
            'name' => 'Fax.svg',
            'description' => 'Figura Fax',
        ],
        [
            'name' => 'File Document.svg',
            'description' => 'Figura Documento de archivo',
        ],
        [
            'name' => 'Financial.svg',
            'description' => 'Figura Financiero',
        ],
        [
            'name' => 'Finger Print.svg',
            'description' => 'Figura Huella digital',
        ],
        [
            'name' => 'ID Card.svg',
            'description' => 'Figura Tarjeta de identificación',
        ],
        [
            'name' => 'Interview.svg',
            'description' => 'Figura Entrevista',
        ],
        [
            'name' => 'Job Seeker.svg',
            'description' => 'Figura Buscador de empleo',
        ],
        [
            'name' => 'Leader.svg',
            'description' => 'Figura Lider',
        ],
        [
            'name' => 'Management.svg',
            'description' => 'Figura Gestión',
        ],
        [
            'name' => 'Mork Station.svg',
            'description' => 'Figura Estación de trabajo',
        ],
        [
            'name' => 'Negotiation.svg',
            'description' => 'Figura Negociación',
        ],
        [
            'name' => 'Network.svg',
            'description' => 'Figura Red',
        ],
        [
            'name' => 'Office Chair.svg',
            'description' => 'Figura Silla de oficina',
        ],
        [
            'name' => 'Office Location.svg',
            'description' => 'Figura Ubicación de la oficina',
        ],
        [
            'name' => 'Online Meeting.svg',
            'description' => 'Figura Reunión de oficina',
        ],
        [
            'name' => 'Overwork.svg',
            'description' => 'Figura Sobrecarga de trabajo',
        ],
        [
            'name' => 'Pantry.svg',
            'description' => 'Figura Despensa',
        ],
        [
            'name' => 'Presentation.svg',
            'description' => 'Figura Presentación',
        ],
        [
            'name' => 'Processing.svg',
            'description' => 'Figura Procesamiento',
        ],
        [
            'name' => 'Productivity.svg',
            'description' => 'Figura Productividad',
        ],
        [
            'name' => 'Projector.svg',
            'description' => 'Figura Proyector',
        ],
        [
            'name' => 'Receptionist.svg',
            'description' => 'Figura Recepcionista',
        ],
        [
            'name' => 'Salary.svg',
            'description' => 'Figura Salario',
        ],
        [
            'name' => 'Stationery.svg',
            'description' => 'Figura Papelería',
        ],
        [
            'name' => 'Strategy.svg',
            'description' => 'Figura Estrategia',
        ],
        [
            'name' => 'Target.svg',
            'description' => 'Figura Objetivo',
        ],
        [
            'name' => 'Team.svg',
            'description' => 'Figura Equipo',
        ],
        [
            'name' => 'Teamwork.svg',
            'description' => 'Figura Trabajo en equipo',
        ],
        [
            'name' => 'Verification_1.svg',
            'description' => 'Figura Verificación 1',
        ],
        [
            'name' => 'Verification.svg',
            'description' => 'Figura Verificación',
        ],
        [
            'name' => 'Vision.svg',
            'description' => 'Figura Visión',
        ],
        [
            'name' => 'Website.svg',
            'description' => 'Figura Sitio web',
        ],
        [
            'name' => 'Working Time.svg',
            'description' => 'Figura Tiempo de trabajo',
        ],

    ],

    //path: /assets/icons/medical
    'medicalFigures' => [
        [
            "name" => "icon_Ambulance, car, emergency-26.svg",
            "description" => "Ambulancia"
        ],
        [
            "name" => "icon_Ambulance, car, emergency-87.svg",
            "description" => "Ambulancia 2"
        ],
        [
            "name" => "icon_Anatomy, cardiology, heart, organ.svg",
            "description" => "Anatomía, cardiología, corazón, órgano"
        ],
        [
            "name" => "icon_Antivirus, injection, syringe, vaccine, medicine.svg",
            "description" => "Antivirus, inyección, jeringa, vacuna, medicina"
        ],
        [
            "name" => "icon_Bacteria, disease, protection, safety, shield, virus, check mark.svg",
            "description" => "Bacteria, enfermedad, protección, seguridad, escudo, virus, marca de verificación"
        ],
        [
            "name" => "icon_Blood, infected, test-48.svg",
            "description" => "Sangre, infectada, prueba"
        ],
        [
            "name" => "icon_Blood, infected, test-95.svg",
            "description" => "Sangre, infectada, prueba"
        ],
        [
            "name" => "icon_Body temperature, check, scan, thermometer, infrared thermometer.svg",
            "description" => "Temperatura corporal, chequeo, escaneo, termómetro, termómetro infrarrojo"
        ],
        [
            "name" => "icon_Building, clinic, hospital-88.svg",
            "description" => "Edificio, clínica, hospital"
        ],
        [
            "name" => "icon_Building, clinic, hospital-99.svg",
            "description" => "Edificio, clínica, hospital"
        ],
        [
            "name" => "icon_Capsule, drugs, medical, pills.svg",
            "description" => "Cápsula, medicamentos, médico, píldoras"
        ],
        [
            "name" => "icon_Clean, cleaning, hand, hygiene, wash, washing-51.svg",
            "description" => "Limpio, limpieza, mano, higiene, lavado, lavado"
        ],
        [
            "name" => "icon_Clean, cleaning, hand, hygiene, wash, washing-52.svg",
            "description" => "Limpio, limpieza, mano, higiene, lavado, lavado"
        ],
        [
            "name" => "icon_Corona virus, Covid-19, bacteria.svg",
            "description" => "Corona virus, Covid-19, bacteria"
        ],
        [
            "name" => "icon_Corona virus, Covid-19, clock.svg",
            "description" => "Corona virus, Covid-19, reloj"
        ],
        [
            "name" => "icon_Corona virus, Covid-19.svg",
            "description" => "Corona virus, Covid-19"
        ],
        [
            "name" => "icon_Cough, coughing, flu, infection, sick.svg",
            "description" => "Tos, tos, gripe, infección, enfermo"
        ],
        [
            "name" => "icon_DNA.svg",
            "description" => "ADN"
        ],
        [
            "name" => "icon_Death, percent, rate, rates, skull.svg",
            "description" => "Muerte, porcentaje, tasa, tasas, calavera"
        ],
        [
            "name" => "icon_Distance, keep, social, social distancing, check mark.svg",
            "description" => "Distancia, mantener, social, distanciamiento social, marca de verificación"
        ],
        [
            "name" => "icon_Electrocardiographs.svg",
            "description" => "Electrocardiogramas"
        ],
        [
            "name" => "icon_Hygiene, toothpaste, tube.svg",
            "description" => "Higiene, pasta de dientes, tubo"
        ],
        [
            "name" => "icon_Kidneys, organ.svg",
            "description" => "Riñones, órgano"
        ],
        [
            "name" => "icon_Organ, stomach.svg",
            "description" => "Órgano, estómago"
        ],
        [
            "name" => "icon_Ultrasound.svg",
            "description" => "Ultrasonido"
        ],
        [
            "name" => "icon_X-ray, X.svg",
            "description" => "Rayos X, X"
        ],
        [
            "name" => "icon_X-ray, check mark.svg",
            "description" => "Rayos X, marca de verificación"
        ],
        [
            "name" => "icon_X-ray.svg",
            "description" => "Rayos X"
        ],
        [
            "name" => "icon_analysis, test, test tubes, Blood, infected.svg",
            "description" => "Análisis, prueba, tubos de ensayo, sangre, infectada"
        ],
        [
            "name" => "icon_anti-AIDS.svg",
            "description" => "Anti-SIDA"
        ],
        [
            "name" => "icon_blood transfusion.svg",
            "description" => "Transfusión de sangre"
        ],
        [
            "name" => "icon_brain, mind, organ.svg",
            "description" => "Cerebro, mente, órgano"
        ],
        [
            "name" => "icon_call, hand, phone, mobile, smartphome, mobile phone.svg",
            "description" => "Llamar, mano, teléfono, móvil, teléfono inteligente, teléfono móvil"
        ],
        [
            "name" => "icon_child, care, insurance, hands, baby.svg",
            "description" => "Niño, cuidado, seguro, manos, bebé"
        ],
        [
            "name" => "icon_coronavirus, covid 19, news, virus, document.svg",
            "description" => "Coronavirus, covid 19, noticias, virus, documento"
        ],
        [
            "name" => "icon_cross, plus, medicine.svg",
            "description" => "Cruz, más, medicina"
        ],
        [
            "name" => "icon_cross, star, medicine.svg",
            "description" => "Cruz, estrella, medicina"
        ],
        [
            "name" => "icon_crowded, people, prevent, social distancing, extras, ban.svg",
            "description" => "Lleno de gente, gente, prevenir, distanciamiento social, extras, prohibición"
        ],
        [
            "name" => "icon_crutches.svg",
            "description" => "Muletas"
        ],
        [
            "name" => "icon_dna, chromosome, biology.svg",
            "description" => "ADN, cromosoma, biología"
        ],
        [
            "name" => "icon_donor.svg",
            "description" => "Donante"
        ],
        [
            "name" => "icon_email, diagnosis, doctor's opinion.svg",
            "description" => "Correo electrónico, diagnóstico, opinión del médico"
        ],
        [
            "name" => "icon_emergency call.svg",
            "description" => "Llamada de emergencia"
        ],
        [
            "name" => "icon_emergency helicopter.svg",
            "description" => "Helicóptero de emergencia"
        ],
        [
            "name" => "icon_eye, Organ, see.svg",
            "description" => "Ojo, órgano, ver"
        ],
        [
            "name" => "icon_female, woman, doctor.svg",
            "description" => "Mujer, mujer, doctor"
        ],
        [
            "name" => "icon_female, woman, nurse.svg",
            "description" => "Mujer, mujer, enfermera"
        ],
        [
            "name" => "icon_fever, sick.svg",
            "description" => "Fiebre, enfermo"
        ],
        [
            "name" => "icon_gall, liver, organ.svg",
            "description" => "Gall, hígado, órgano"
        ],
        [
            "name" => "icon_hand, Clean, healthy, protection, safe, shield, check mark.svg",
            "description" => "Mano, limpio, saludable, protección, seguro, escudo, marca de verificación"
        ],
        [
            "name" => "icon_hands, shield, protection, insurance, medical insurance.svg",
            "description" => "Manos, escudo, protección, seguro, seguro médico"
        ],
        [
            "name" => "icon_handshake, forbidden.svg",
            "description" => "Apretón de manos, prohibido"
        ],
        [
            "name" => "icon_health care.svg",
            "description" => "Cuidado de la salud"
        ],
        [
            "name" => "icon_health, human, person, body.svg",
            "description" => "Salud, humano, persona, cuerpo"
        ],
        [
            "name" => "icon_health, human, person, shield, immunity-100.svg",
            "description" => "Salud, humano, persona, escudo, inmunidad"
        ],
        [
            "name" => "icon_health, human, person, shield, immunity-96.svg",
            "description" => "Salud, humano, persona, escudo, inmunidad"
        ],
        [
            "name" => "icon_healthcare, medical, protection.svg",
            "description" => "Atención médica, médica, protección"
        ],
        [
            "name" => "icon_healthy weight.svg",
            "description" => "Peso saludable"
        ],
        [
            "name" => "icon_heartbeat rate.svg",
            "description" => "Ritmo cardíaco"
        ],
        [
            "name" => "icon_home, house, protection, self quarantine, social distancing, quarantine.svg",
            "description" => "Casa, casa, protección, cuarentena, distanciamiento social, cuarentena"
        ],
        [
            "name" => "icon_hospital bed, hospital, bed.svg",
            "description" => "Cama de hospital, hospital, cama"
        ],
        [
            "name" => "icon_hospital location.svg",
            "description" => "Ubicación del hospital"
        ],
        [
            "name" => "icon_human, person, body.svg",
            "description" => "Humano, persona, cuerpo"
        ],
        [
            "name" => "icon_human, person, shield, immunity, insurance.svg",
            "description" => "Humano, persona, escudo, inmunidad, seguro"
        ],
        [
            "name" => "icon_infection, spread, society.svg",
            "description" => "Infección, propagación, sociedad"
        ],
        [
            "name" => "icon_injection.svg",
            "description" => "Inyección"
        ],
        [
            "name" => "icon_insurance, medical insurance, nsurance payments.svg",
            "description" => "Seguro, seguro médico, pagos de seguro"
        ],
        [
            "name" => "icon_lung, protection, safe, shield, check mark.svg",
            "description" => "Pulmón, protección, seguro, escudo, marca de verificación"
        ],
        [
            "name" => "icon_lungs, Organ.svg",
            "description" => "Pulmones, órgano"
        ],
        [
            "name" => "icon_lungs, pneumonia, virus, flu.svg",
            "description" => "Pulmones, neumonía, virus, gripe"
        ],
        [
            "name" => "icon_male, man, doctor.svg",
            "description" => "Hombre, hombre, doctor"
        ],
        [
            "name" => "icon_male, man, nurse.svg",
            "description" => "Hombre, hombre, enfermero"
        ],
        [
            "name" => "icon_man, mask, sick, protection myself.svg",
            "description" => "Hombre, máscara, enfermo, protección a mí mismo"
        ],
        [
            "name" => "icon_medical apps.svg",
            "description" => "Aplicaciones médicas"
        ],
        [
            "name" => "icon_medical case.svg",
            "description" => "Caso médico"
        ],
        [
            "name" => "icon_medical folder.svg",
            "description" => "Carpeta médica"
        ],
        [
            "name" => "icon_medical prescription.svg",
            "description" => "Receta médica"
        ],
        [
            "name" => "icon_medical records-07.svg",
            "description" => "Registros médicos"
        ],
        [
            "name" => "icon_medical records-44.svg",
            "description" => "Registros médicos"
        ],
        [
            "name" => "icon_medicament.svg",
            "description" => "Medicamento"
        ],
        [
            "name" => "icon_mobile app.svg",
            "description" => "Aplicación móvil"
        ],
        [
            "name" => "icon_nurse.svg",
            "description" => "Enfermera"
        ],
        [
            "name" => "icon_oculist, glasses, ophthalmology.svg",
            "description" => "Oculista, gafas, oftalmología"
        ],
        [
            "name" => "icon_online healthcare.svg",
            "description" => "Atención médica en línea"
        ],
        [
            "name" => "icon_pharmacy.svg",
            "description" => "Farmacia"
        ],
        [
            "name" => "icon_phonendoscope.svg",
            "description" => "Fonendoscopio"
        ],
        [
            "name" => "icon_protection, self quarantine, social distancing, quarantine.svg",
            "description" => "Protección, cuarentena, distanciamiento social, cuarentena"
        ],
        [
            "name" => "icon_research, biology, Corona virus, Covid-19, magnifier.svg",
            "description" => "Investigación, biología, Corona virus, Covid-19, lupa"
        ],
        [
            "name" => "icon_research, biology, Corona virus, Covid-19, microscope.svg",
            "description" => "Investigación, biología, Corona virus, Covid-19, microscopio"
        ],
        [
            "name" => "icon_rna, chromosome, biology.svg",
            "description" => "ARN, cromosoma, biología"
        ],
        [
            "name" => "icon_sanitizer, personal care products.svg",
            "description" => "Desinfectante, productos de cuidado personal"
        ],
        [
            "name" => "icon_sick, runny nose.svg",
            "description" => "Enfermo, nariz que moquea"
        ],
        [
            "name" => "icon_sick, sore, throat.svg",
            "description" => "Enfermo, dolor, garganta"
        ],
        [
            "name" => "icon_skull, braincase, brainpan, death.svg",
            "description" => "Cráneo, cráneo, cráneo, muerte"
        ],
        [
            "name" => "icon_stomatology.svg",
            "description" => "Estomatología"
        ],
        [
            "name" => "icon_stop, Corona virus, Covid-19.svg",
            "description" => "Detener, Corona virus, Covid-19"
        ],
        [
            "name" => "icon_thermometer-18.svg",
            "description" => "Termómetro"
        ],
        [
            "name" => "icon_thermometer-46.svg",
            "description" => "Termómetro"
        ],
        [
            "name" => "icon_tooth, dentistry.svg",
            "description" => "Diente, odontología"
        ],
        [
            "name" => "icon_wheelchair.svg",
            "description" => "Silla de ruedas"
        ]
    ],

    'menu' => [
        [
            'title' => "Dashboard",
            'value' => "dashboard",
            'icon' => "mdi-monitor-dashboard",
            'to' => "/a",
            'can' => null,
            'group' => null,
        ],

        [
            'title' => "Gestión de usuarios",
            'value' => "users",
            'icon' => "mdi-account-group",
            'to' => "/a/users",
            'can' => 'a.users',
            'group' => null,
        ],

        [
            'title' => "Gestion institucional",
            'value' => "institutional",
            'icon' => "mdi-domain",
            'to' => "#",
            'can' => 'a.institutional|a.workers|a.sliders',
            'group' => [
                [
                    'title' => "Hospital",
                    'value' => "institutional",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/institutional-information",
                    'can' => 'a.institutional',
                    'group' => null,
                ],
                [
                    'title' => "Getion del personal",
                    'value' => "institutional",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'can' => 'a.workers',
                    'to' => "/a/workers",
                    'group' => null,
                ],

                [
                    'title' => "Slider",
                    'value' => "web",
                    'to' => "/a/sliders",
                    'can' => 'a.sliders',
                    'group' => null,
                ],
            ],
        ],

        [
            'title' => "Gestión de servicios",
            'value' => "services",
            'icon' => "mdi-toolbox-outline",
            'to' => "consultas",
            'can' => 'a.final-services|a.intermediate-services|a.offices',
            'group' => [
                [
                    'title' => "Servicios finales",
                    'value' => "services",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/final-services",
                    'can' => 'a.final-services',
                    'group' => null,
                ],
                [
                    'title' => "Servicios intermedios",
                    'value' => "services",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/intermediate-services",
                    'can' => 'a.intermediate-services',
                    'group' => null,
                ],

                [
                    'title' => "Oficinas",
                    'value' => "services",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/offices",
                    'can' => 'a.offices',
                    'group' => null,
                ],
            ],
        ],

        [
            'title' => "G. de info. al usuario",
            'value' => "info",
            'icon' => "mdi-account-question",
            'to' => "#",
            'can' => 'a.service-portfolios|a.guidance-documents',
            'group' => [
                [
                    'title' => "Cartera de servicios",
                    'value' => "info",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/service-portfolios",
                    'can' => 'a.service-portfolios',
                    'group' => null,
                ],
                [
                    'title' => "Circuitos de atención",
                    'value' => "info",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/guidance-documents",
                    'can' => 'a.guidance-documents',
                    'group' => null,
                ],
            ],
        ],

        [
            'title' => "G. informes y publicaciones",
            'value' => "plubli",
            'icon' => "mdi-repeat",
            'to' => "mensajes",
            'can' => 'a.announcements|a.purchase-and-service|a.publications',
            'group' => [
                [
                    'title' => "Convocatorias",
                    'value' => "plubli",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/announcements",
                    'can' => 'a.announcements',
                    'group' => null,
                ],
                [
                    'title' => "Compra y servicio",
                    'value' => "plubli",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/purchase-and-service",
                    'can' => 'a.purchase-and-service',
                    'group' => null,
                ],
                [
                    'title' => "Publicaciones",
                    'value' => "consultar",
                    'icon' => "mdi-post",
                    'to' => "/a/publications",
                    'can' => 'a.publications',
                    'group' => null,
                ],
            ],
        ],
        [
            'title' => "Gestión de noticias",
            'value' => "consultar",
            'icon' => "mdi-newspaper-variant-multiple-outline",
            'to' => "/a/news",
            'can' => 'a.news',
            'group' => null,
        ],
        
        [
            'title' => "Gestión de campañas y eventos",
            'value' => "consultar",
            'icon' => "mdi-calendar-multiple-check",
            'to' => "/a/events",
            'can' => 'a.events',
            'group' => null,
        ],
        [
            'title' => "Configuración",
            'value' => "configuracion",
            'icon' => "mdi-cog-outline",
            'to' => "#",
            'can' => 'a.supporting-services|a.specialties|a.areas',
            'group' => [
                [
                    'title' => "Servicios de apoyo",
                    'value' => "configuracion",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/supporting-services",
                    'can' => 'a.supporting-services',
                    'group' => null,
                ],
                [
                    'title' => "Epecialidades",
                    'value' => "configuracion",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/specialties",
                    'can' => 'a.specialties',
                    'group' => null,
                ],

                [
                    'title' => "Areas",
                    'value' => "areas",
                    'icon' => "mdi-inbox-arrow-down-outline",
                    'to' => "/a/areas",
                    'can' => 'a.areas',
                    'group' => null,
                ],
            ],
        ],
    ],

];

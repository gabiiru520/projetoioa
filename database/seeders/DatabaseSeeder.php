<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\PageContent;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@ioanatal.com.br'],
            [
                'name' => 'Diretoria IOA Natal',
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Settings
        $settings = [
            'site_name' => ['value' => 'IOA Natal — Instituto de Odontologia das Américas', 'group' => 'general'],
            'site_tagline' => ['value' => 'Referência Internacional em Pós-Graduação Odontológica', 'group' => 'general'],
            'whatsapp_number' => ['value' => '5584998765432', 'group' => 'contact'],
            'whatsapp_default_message' => ['value' => 'Olá! Gostaria de mais informações sobre os cursos e turmas do IOA Natal.', 'group' => 'contact'],
            'phone' => ['value' => '(84) 3211-9800', 'group' => 'contact'],
            'email' => ['value' => 'contato@ioanatal.com.br', 'group' => 'contact'],
            'address' => ['value' => 'Av. Governador Tarcísio de Vasconcelos Maia, 1500 - Candelária, Natal - RN, 59065-000', 'group' => 'contact'],
            'business_hours' => ['value' => 'Segunda a Sexta: 08:00 às 18:30 | Sábados de aula: 08:00 às 17:00', 'group' => 'contact'],
            'instagram' => ['value' => 'https://instagram.com/ioanatal', 'group' => 'social'],
            'facebook' => ['value' => 'https://facebook.com/ioanatal', 'group' => 'social'],
            'youtube' => ['value' => 'https://youtube.com/@ioanatal', 'group' => 'social'],
            'linkedin' => ['value' => 'https://linkedin.com/company/ioanatal', 'group' => 'social'],
            'google_maps_embed' => ['value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.191632734139!2d-35.21558232412852!3d-5.828608857771746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7b2ff90fb4b3701%3A0x6b04b503029a1b1b!2sNatal%2C%20RN!5e0!3m2!1spt-BR!2sbr!4v1700000000000!5m2!1spt-BR!2sbr', 'group' => 'contact'],
            'seo_meta_title' => ['value' => 'IOA Natal | Pós-Graduação, Especialização e Imersão Odontológica', 'group' => 'seo'],
            'seo_meta_description' => ['value' => 'O maior ecossistema de ensino odontológico das Américas em Natal/RN. Cursos de Especialização em Implantodontia, Ortodontia, HOF e Odontologia Digital.', 'group' => 'seo'],
        ];

        foreach ($settings as $key => $data) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $data['value'], 'group' => $data['group']]
            );
        }

        // 3. Page Contents
        $pages = [
            [
                'page' => 'home',
                'section' => 'hero',
                'title' => 'A Mais Alta Performance na Odontologia das Américas',
                'subtitle' => 'Eleve sua prática clínica ao padrão internacional na sede mais moderna de pós-graduação odontológica de Natal/RN.',
                'content' => 'O IOA Natal conecta você à tecnologia 3D de ponta, aos professores mais renomados do Brasil e do mundo, e a uma metodologia com ampla prática clínica sobre pacientes reais.',
                'extra_data' => [
                    'badge' => 'Rede Internacional • Mais de 50 unidades no mundo',
                    'stat_students' => '+15.000',
                    'stat_students_label' => 'Especialistas formados pela rede',
                    'stat_rating' => '99.4%',
                    'stat_rating_label' => 'Índice de aprovação clínica',
                    'stat_clinics' => '100%',
                    'stat_clinics_label' => 'Prática em centro cirúrgico real',
                ]
            ],
            [
                'page' => 'home',
                'section' => 'about_summary',
                'title' => 'Excelência Internacional ao Alcance do Seu Consultório',
                'subtitle' => 'Mais do que uma escola: um centro acelerador de carreiras e inovação odontológica.',
                'content' => 'Com instalações concebidas para replicar os mais exigentes hospitais e clínicas da Europa e dos Estados Unidos, o IOA Natal proporciona aos cirurgiões-dentistas uma formação clínica e cirúrgica incomparável. Nossos alunos dominam desde o diagnóstico tomográfico tridimensional e fluxo digital até cirurgias guiadas e protocolos avançados de reabilitação.',
                'extra_data' => [
                    'pilar_1_title' => 'Corpo Docente de Renome',
                    'pilar_1_desc' => 'Doutores, mestres e autores de livros com vasta experiência clínica real.',
                    'pilar_2_title' => 'Prática Cirúrgica Intensa',
                    'pilar_2_desc' => 'Atendimento a pacientes reais sob mentoria direta dos coordenadores em clínicas de ponta.',
                    'pilar_3_title' => 'Fluxo 100% Digital',
                    'pilar_3_desc' => 'Scanners intraorais, softwares CAD/CAM e tomógrafos de alta resolução integrados às aulas.',
                ]
            ],
            [
                'page' => 'sobre',
                'section' => 'institucional',
                'title' => 'Sobre o IOA Natal',
                'subtitle' => 'Tradição internacional, tecnologia de vanguarda e compromisso com o futuro da odontologia.',
                'content' => 'O Instituto de Odontologia das Américas (IOA) é a maior rede de educação continuada e pós-graduação odontológica premium da América Latina, integrando a prestigiosa Dan Robson International Academy. Em Natal/RN, trouxemos uma estrutura física e tecnológica jamais vista no estado, projetada para atender aos profissionais que buscam se destacar de forma definitiva no mercado odontológico.',
                'extra_data' => [
                    'missao' => 'Capacitar cirurgiões-dentistas com o que há de mais avançado na ciência e na prática odontológica global, formando líderes clínicos de alta performance.',
                    'visao' => 'Ser reconhecido como o principal polo de excelência e inovação no ensino odontológico do Nordeste, integrando tecnologia 3D e humanização.',
                    'valores' => 'Rigor científico inegociável, ética profissional, inovação contínua, paixão pelo ensino e valorização do ser humano.',
                ]
            ],
            [
                'page' => 'contato',
                'section' => 'info',
                'title' => 'Venha Conhecer a Nova Era da Odontologia',
                'subtitle' => 'Nossa equipe de consultores de carreira está pronta para apresentar nossa sede e esclarecer todas as suas dúvidas.',
                'content' => 'Agende uma visita guiada às nossas clínicas, conheça nosso centro cirúrgico e converse diretamente com nossos coordenadores pedagógicos.',
                'extra_data' => [
                    'whatsapp_cta_text' => 'Falar agora com um consultor acadêmico',
                ]
            ]
        ];

        foreach ($pages as $p) {
            PageContent::updateOrCreate(
                ['page' => $p['page'], 'section' => $p['section']],
                [
                    'title' => $p['title'],
                    'subtitle' => $p['subtitle'],
                    'content' => $p['content'],
                    'extra_data' => $p['extra_data'],
                ]
            );
        }

        // 4. Courses
        $coursesData = [
            [
                'title' => 'Especialização em Implantodontia com Prótese sobre Implante e Fluxo Digital',
                'slug' => 'especializacao-implantodontia-fluxo-digital',
                'category' => 'Especialização',
                'modality' => 'Presencial',
                'summary' => 'Formação de alto nível cirúrgico e protético: cirurgia guiada 3D, carga imediata, enxertos ósseos avançados e reabilitação sobre implantes.',
                'description' => 'A Especialização em Implantodontia do IOA Natal é projetada para capacitar o cirurgião-dentista a planejar e executar reabilitações implanto-suportadas desde os casos unitários até reconstruções totais complexas com atrofias ósseas severas. O curso conta com intensa prática clínica em pacientes e laboratório de biomodelagem 3D, permitindo que você execute cirurgias guiadas com máxima previsibilidade e segurança.',
                'duration_workload' => '850 horas • 24 módulos mensais',
                'schedule_info' => 'Quinta-feira a Sábado (um final de semana por mês)',
                'target_audience' => 'Cirurgiões-dentistas graduados que desejam dominar a cirurgia de implantes e a reabilitação protética moderna.',
                'syllabus' => "• Módulo 1: Fundamentos de Osseointegração e Tomografia Computadorizada Cone Beam\n• Módulo 2: Princípios Biológicos e Farmacologia Aplicada à Implantodontia\n• Módulo 3: Incisões, Suturas e Técnicas de Preservação Alveolar\n• Módulo 4: Hands-on em Manequins e Cirurgias Guiadas por Computador\n• Módulo 5: Carga Imediata em Área Estética e Protocolo All-on-4\n• Módulo 6: Enxertos Ósseos em Bloco, Particulados e Biomateriais\n• Módulo 7: Levantamento de Seio Maxilar (Sinus Lift) - Técnicas Aberta e Fechada\n• Módulo 8: Cirurgia Plástica Periodontal e Peri-implantar\n• Módulo 9: Prótese sobre Implante Cimentada vs Parafusada e Fluxo Digital CAD/CAM\n• Módulo 10: Manejo de Complicações e Tratamento de Peri-implantite\n• Módulos 11 a 24: Clínica Cirúrgica e Protética Intensiva com Pacientes Reais",
                'investment' => 'Consulte condições exclusivas de matrícula antecipada com nossa equipe',
                'coordinator' => 'Prof. Dr. Marcelo Albuquerque (Doutor em Implantodontia pela USP)',
                'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Especialização em Harmonização Orofacial (HOF) Avançada e Anatomia Cirúrgica',
                'slug' => 'especializacao-harmonizacao-orofacial-avancada',
                'category' => 'Especialização',
                'modality' => 'Presencial',
                'summary' => 'Domine a arte e a ciência da estética facial: toxina botulínica, preenchedores de ácido hialurônico, bioestimuladores de colágeno e fios de sustentação.',
                'description' => 'O curso de Especialização em HOF do IOA Natal entrega uma sólida formação anatômica com foco em segurança, naturalidade e manejo de intercorrências. O aluno pratica intensamente com técnicas de mapeamento vascular, ultrassonografia estética facial e procedimentos guiados por cânulas de ponta romba.',
                'duration_workload' => '500 horas • 18 módulos mensais',
                'schedule_info' => 'Quarta a Sexta (mensal)',
                'target_audience' => 'Cirurgiões-dentistas que buscam excelência e certificação oficial em Harmonização Orofacial reconhecida pelo CFO.',
                'syllabus' => "• Anatomia Topográfica e Estratigrafia Facial Aplicada\n• Zonas de Perigo e Mapeamento com Ultrassom de Alta Frequência\n• Toxina Botulínica Tipo A: Protocolos Avançados, Terço Superior, Médio e Inferior\n• Preenchedores com Ácido Hialurônico: Rinomodelação, Malar, Mandíbula e Labial\n• Bioestimuladores de Colágeno (PLLA, Hidroxiapatita de Cálcio e Polidioxanona)\n• Fios de PDO e Fios Espiculados de Tração Facial\n• Manejo Imediato de Intercorrências e Hialuronidase Reversa\n• Clínica Ativa com Atendimento a Mais de 30 Pacientes por Aluno",
                'investment' => 'Parcelamento facilitado em até 24x sem juros no plano acadêmico',
                'coordinator' => 'Profa. Dra. Carolina Vasconcelos (Mestre em Anatomia e Especialista em HOF)',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Especialização em Ortodontia Contemporânea com Alinhadores Invisíveis e Autoligados',
                'slug' => 'especializacao-ortodontia-alinhadores-invisiveis',
                'category' => 'Especialização',
                'modality' => 'Presencial',
                'summary' => 'Formação ortodôntica moderna integrando diagnóstico 3D, prescrições autoligadas passivas e planejamento digital de alinhadores transparentes.',
                'description' => 'Aprenda a tratar más oclusões com eficiência biomecânica e estética. O curso capacita você a diagnosticar com precisão através de tomografia, fotografias digitais e modelos virtuais, utilizando sistemas autoligados e softwares de movimentação dentária para criar seus próprios alinhadores ou trabalhar com as maiores marcas mundiais.',
                'duration_workload' => '1.200 horas • 30 módulos mensais',
                'schedule_info' => 'Quinta a Sábado (mensal)',
                'target_audience' => 'Cirurgiões-dentistas que desejam se tornar especialistas em Ortodontia com diferencial tecnológico.',
                'syllabus' => "• Cefalometria Computadorizada e Análise Facial 3D\n• Biomecânica Ortodôntica Fundamental e Sistemas Autoligados\n• Mini-implantes Ortodônticos e Ancoragem Esquelética (MARPE)\n• Fluxo Completo de Alinhadores Invisíveis (Setup Virtual, Attachments e IPR)\n• Tratamento de Maloclusões de Classe II e Classe III sem Extração\n• Ortodontia Pré-Cirúrgica para Deformidades Dentofaciais\n• Finalização Estética e Protocolos de Contenção\n• Clínica com Acompanhamento Longitudinal de Casos",
                'investment' => 'Consulte condições com desconto pontualidade',
                'coordinator' => 'Prof. Me. Rodrigo Cavalcanti (Especialista e Mestre em Ortodontia)',
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Especialização em Endodontia Microscópica e Sistemas Rotatórios / Reciprocantes',
                'slug' => 'especializacao-endodontia-microscopica-sistemas-rotatorios',
                'category' => 'Especialização',
                'modality' => 'Presencial',
                'summary' => 'Odontologia de alta precisão com microscópio operatório, ultrassom, localizadores apicais e obturação termoplastificada em sessão única.',
                'description' => 'A endodontia atual exige visualização magnificada e velocidade com segurança biológica. No IOA Natal, cada aluno conta com posto individual equipado com microscopia cirúrgica de alta resolução, motores endodônticos inteligentes e sistemas de irrigação sônica e ultrassônica.',
                'duration_workload' => '750 horas • 20 módulos mensais',
                'schedule_info' => 'Sexta e Sábado (mensal)',
                'target_audience' => 'Dentistas que buscam segurança absoluta em tratamentos e retratamentos endodônticos complexos.',
                'syllabus' => "• Magnificação Óptica: Uso do Microscópio Operatório na Endodontia\n• Anatomia Interna Complexa e Localização de Canais Extras (MV2)\n• Sistemas Mecanizados: Cinemática Rotatória e Reciprocante de Última Geração\n• Desinfecção Avançada com Ultrassom e Soluções Químicas Irrigadoras\n• Obturação Termoplastificada Tridimensional e Cimentos Biocerâmicos\n• Remoção de Instrumentos Fraturados e Desobturação de Canais\n• Cirurgia Parendodôntica Guiada com Microscopia",
                'investment' => 'Planos corporativos e facilidade de pagamento',
                'coordinator' => 'Profa. Dra. Mariana Linhares (Doutora em Clínica Odontológica / Endodontia)',
                'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Imersão VIP em Lentes de Contato Dental e Cerâmicas Ultrafinas',
                'slug' => 'imersao-lentes-contato-dental-ceramicas',
                'category' => 'Imersão',
                'modality' => 'Presencial',
                'summary' => '3 dias de pura prática clínica e laboratorial: mock-up guiado, preparos minimamente invasivos, cimentação adesiva e fotografia odontológica.',
                'description' => 'Um treinamento intensivo focado na estética do sorriso. Desde o planejamento digital DSD (Digital Smile Design) até o refinamento oclusal e cimentação livre de falhas.',
                'duration_workload' => '36 horas • 3 dias intensivos (Quinta a Sábado)',
                'schedule_info' => 'Imersão integral das 08h às 20h',
                'target_audience' => 'Cirurgiões-dentistas que querem elevar o ticket médio do consultório com reabilitações estéticas de excelência.',
                'syllabus' => "• Planejamento DSD e Fotografia Odontológica de Estúdio\n• Seleção de Resinas Bisacrílicas e Prova Estética (Mock-up)\n• Preparos Guiados por Guia de Silicone com Desgaste Ultraconservador\n• Sistemas Cerâmicos: Dissilicato de Lítio, Zircônia e Feldspática\n• Isolamento Absoluto e Protocolos de Cimentação Resinosa Adesiva\n• Ajuste Oclusal e Acabamento de Margens Cervicais",
                'investment' => 'Vagas estritamente limitadas a 12 alunos por turma',
                'coordinator' => 'Prof. Dr. Eduardo Sampaio (Especialista em Dentística Restauradora)',
                'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Aperfeiçoamento em Cirurgia Oral Menor e Terceiros Molares Inclusos',
                'slug' => 'aperfeicoamento-cirurgia-oral-menor-terceiros-molares',
                'category' => 'Aperfeiçoamento',
                'modality' => 'Presencial',
                'summary' => 'Ganhe total destreza e segurança em exodontias complexas, dentes inclusos, dentes impactados, frenectomias e biópsias orais.',
                'description' => 'Curso 80% prático com alta demanda cirúrgica de pacientes selecionados pela triagem do IOA Natal. Ideal para quem deseja operar sem medo e com técnicas consagradas.',
                'duration_workload' => '120 horas • 6 módulos mensais',
                'schedule_info' => 'Sexta e Sábado (mensal)',
                'target_audience' => 'Cirurgiões-dentistas recém-graduados e experientes que querem aprimorar habilidades cirúrgicas ambulatoriais.',
                'syllabus' => "• Avaliação Pré-Operatória e Risco Cirúrgico\n• Anestesiologia Local e Técnicas Anestésicas de Bloqueio Regional\n• Classificações de Pell & Gregory e Winter para Terceiros Molares\n• Odontossecção e Osteotomia com Peças Cirúrgicas de Alta Performance\n• Preservação do Nervo Alveolar Inferior e Manejo de Parestesias\n• Suturas Odontológicas Avançadas e Farmacoterapia Pós-Operatória",
                'investment' => 'Consulte condições para inscrições antecipadas',
                'coordinator' => 'Prof. Me. Bruno Farias (Cirurgião Bucomaxilofacial)',
                'image' => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($coursesData as $cData) {
            $course = Course::updateOrCreate(
                ['slug' => $cData['slug']],
                $cData
            );

            // 5. Turma vinculada para cada curso
            Turma::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'title' => 'Turma 2026.1 — ' . $course->title,
                ],
                [
                    'start_date' => now()->addDays(20 + ($course->id * 7))->toDateString(),
                    'schedule' => $cData['schedule_info'],
                    'modality' => $cData['modality'],
                    'spots' => 'Últimas 4 vagas',
                    'status' => 'Inscrições abertas',
                    'whatsapp_message' => "Olá! Gostaria de garantir minha vaga na {$course->title} (Turma 2026.1) no IOA Natal.",
                    'is_featured' => true,
                ]
            );
        }

        // 6. Portfolio Items
        $portfolioData = [
            [
                'title' => 'Complexo Clínico Multidisciplinar',
                'category' => 'Instalações',
                'description' => 'Amplas clínicas com 24 equipos odontológicos de alta tecnologia, monitores acoplados para diagnóstico digital e iluminação cirúrgica LED.',
                'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Sede Natal/RN',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Centro Cirúrgico Avançado para Implantodontia e HOF',
                'category' => 'Centro Cirúrgico',
                'description' => 'Ambiente estéril com fluxo hospitalar, sistema de sedação com óxido nitroso e telemetria para cirurgias ao vivo.',
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Centro Cirúrgico IOA',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Laboratório 3D & Scanner Intraoral Digital',
                'category' => 'Tecnologia',
                'description' => 'Estações equipadas com softwares Exocad, scanners 3D e impressoras tridimensionais para cirurgias guiadas e alinhadores.',
                'image' => 'https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Hub Digital IOA',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Atendimento Clínico com Pacientes Reais',
                'category' => 'Aulas Práticas',
                'description' => 'Alunos operando sob supervisão direta e mentoria individualizada de nossos professores doutores.',
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Prática Clínica',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Cerimônia de Formatura e Certificação Internacional',
                'category' => 'Turmas Formadas',
                'description' => 'Celebração da conclusão de turmas de Especialistas reconhecidos nacional e internacionalmente.',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Graduação de Especialistas',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Auditório Master com Transmissão 4K',
                'category' => 'Instalações',
                'description' => 'Auditório com capacidade para grandes palestras, simpósios e imersões teóricas de padrão internacional.',
                'image' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80',
                'date_label' => 'Auditório IOA',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($portfolioData as $pData) {
            PortfolioItem::updateOrCreate(
                ['title' => $pData['title']],
                $pData
            );
        }

        // 7. Team Members
        $teamData = [
            [
                'name' => 'Prof. Dr. Marcelo Albuquerque',
                'role' => 'Diretor Clínico & Coordenador de Implantodontia',
                'cro' => 'CRO-RN 4892',
                'bio' => 'Doutor em Implantodontia pela USP com mais de 20 anos de experiência cirúrgica. Autor de artigos internacionais e pioneiro em cirurgia guiada no RN.',
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'name' => 'Profa. Dra. Carolina Vasconcelos',
                'role' => 'Coordenadora da Especialização em HOF',
                'cro' => 'CRO-RN 5214',
                'bio' => 'Mestre e Doutoranda em Morfologia Facial. Palestrante internacional e referência no uso de ultrassonografia para segurança em preenchedores faciais.',
                'photo' => 'https://images.unsplash.com/photo-1594824813626-d66a9df54ca9?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'name' => 'Prof. Me. Rodrigo Cavalcanti',
                'role' => 'Coordenador da Especialização em Ortodontia',
                'cro' => 'CRO-RN 3980',
                'bio' => 'Mestre em Ortodontia pela FOB-USP. Especialista em Sistemas Autoligados e Alinhadores Invisíveis, com mais de 3.000 sorrisos transformados.',
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'name' => 'Profa. Dra. Mariana Linhares',
                'role' => 'Coordenadora de Endodontia Microscópica',
                'cro' => 'CRO-RN 6112',
                'bio' => 'Doutora em Clínica Odontológica com ênfase em Endodontia. Membro da Sociedade Brasileira de Endodontia e mentora clínica de microscopia.',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
            ],
        ];

        foreach ($teamData as $tData) {
            TeamMember::updateOrCreate(
                ['name' => $tData['name']],
                $tData
            );
        }

        // 8. Blog Posts
        $postsData = [
            [
                'title' => 'Cirurgia Guiada em Implantodontia: Como a Tecnologia 3D Aumenta a Precisão e a Segurança',
                'slug' => 'cirurgia-guiada-implantodontia-tecnologia-3d',
                'category' => 'Implantodontia & Tecnologia',
                'excerpt' => 'Entenda como o planejamento virtual e os guias cirúrgicos tridimensionais reduzem o tempo cirúrgico, diminuem o pós-operatório e garantem a colocação proteticamente guiada dos implantes.',
                'content' => "<h2>A Revolução do Fluxo Digital na Prática Odontológica</h2><p>A odontologia contemporânea abandonou os procedimentos baseados puramente em estimativas anatômicas convencionais. Com o advento da tomografia computadorizada Cone Beam acoplada ao escaneamento intraoral, o cirurgião-dentista tem o mapa tridimensional exato da densidade óssea e das estruturas nobres do paciente.</p><h3>Vantagens da Cirurgia Guiada</h3><ul><li><strong>Menor invasividade:</strong> Em inúmeros casos, elimina-se a necessidade de incisões extensas e retalhos amplos (técnica sem retalho ou flapless).</li><li><strong>Posicionamento proteticamente guiado:</strong> O implante é instalado exatamente no eixo onde a futura coroa protética terá sua máxima resistência biomecânica e estética ideal.</li><li><strong>Pós-operatório incomparável:</strong> Pacientes relatam redução drástica de edema, dor e necessidade de analgésicos fortes.</li></ul><p>No IOA Natal, nossos alunos de especialização planejam e imprimem seus próprios guias cirúrgicos nas impressoras 3D da instituição, dominando todas as etapas clínicas.</p>",
                'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Prof. Dr. Marcelo Albuquerque',
                'tags' => 'Implantodontia, Cirurgia Guiada, Fluxo Digital, 3D',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Mapeamento com Ultrassom em HOF: O Fim das Intercorrências Vasculares',
                'slug' => 'ultrassom-em-harmonizacao-orofacial-seguranca',
                'category' => 'Harmonização Orofacial',
                'excerpt' => 'A ultrassonografia facial tornou-se a ferramenta definitiva para o injetor de alta performance. Saiba como identificar trajetos arteriais anômalos e aplicar preenchedores com blindagem de segurança.',
                'content' => "<h2>Segurança Biológica como Pilar Inegociável</h2><p>A Harmonização Orofacial é uma das especialidades mais procuradas do mercado, mas exige responsabilidade anatômica extrema. A variação vascular na face humana é frequente, e a técnica de aspiração com seringa nem sempre é 100% fidedigna em planos profundos.</p><h3>O que o Ultrassom de Alta Resolução Permite?</h3><p>Com transdutores específicos para dermatologia e tecidos moles da face, conseguimos:</p><ol><li>Identificar o diâmetro e profundidade da artéria facial, artéria labial e seus ramos.</li><li>Avaliar preenchimentos antigos e discernir entre ácido hialurônico, PMMA e fios preexistentes.</li><li>Guiar a aplicação de hialuronidase com visão direta sobre o nódulo ou edema tardio.</li></ol><p>O IOA Natal foi o primeiro centro de pós-graduação do estado a incorporar o ensino de ultrassom nas clínicas da especialização em HOF.</p>",
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Profa. Dra. Carolina Vasconcelos',
                'tags' => 'HOF, Ultrassonografia, Segurança, Ácido Hialurônico',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Alinhadores Invisíveis vs. Aparelhos Fixos: O que Realmente Funciona na Prática Clínica?',
                'slug' => 'alinhadores-invisiveis-vs-aparelhos-fixos-ortodontia',
                'category' => 'Ortodontia',
                'excerpt' => 'Comparativo científico sobre movimentação dentária, adesão do paciente, tempo de tratamento e rentabilidade para o consultório ortodôntico contemporâneo.',
                'content' => "<h2>A Mudança no Perfil do Paciente Adulto</h2><p>O paciente que procura ortodontia hoje não quer fios metálicos aparentes, aftas constantes e restrições alimentares severas. Os alinhadores transparentes deixaram de ser uma opção de nicho e se tornaram o padrão de tratamento em grandes centros globais.</p><h3>Biomecânica dos Alinhadores</h3><p>Engana-se quem pensa que o alinhador substitui o conhecimento do ortodontista. Pelo contrário: exige domínio aprofundado dos pontos de aplicação de força, tipos de attachments (elípticos, retangulares, biselados) e controle de ancoragem.</p><p>Na Especialização em Ortodontia do IOA Natal, capacitamos os alunos a planejar casos reais em softwares abertos e plataformas comerciais líderes, combinando o melhor dos dois mundos.</p>",
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Prof. Me. Rodrigo Cavalcanti',
                'tags' => 'Ortodontia, Alinhadores, Invisíveis, Biomecânica',
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($postsData as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }

        // 9. Sample Contact Message
        ContactMessage::updateOrCreate(
            ['email' => 'dr.ricardocosta@gmail.com'],
            [
                'name' => 'Dr. Ricardo Costa',
                'phone' => '(84) 98822-1144',
                'course_of_interest' => 'Especialização em Implantodontia com Prótese sobre Implante e Fluxo Digital',
                'message' => 'Gostaria de saber quando inicia a próxima turma e qual a documentação necessária para matrícula.',
                'ip_address' => '127.0.0.1',
                'is_read' => false,
            ]
        );
    }
}

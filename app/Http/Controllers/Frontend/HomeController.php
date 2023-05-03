<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Paylasim;
use App\Models\PaylasimTranslation;
use App\Models\Product;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function agreeTerm()
    {
        Session::put('term', true);
        return redirect()->back();
    }

    public function index()
    {
        $categories = [
            'education' => [
                'translations' => ['az' => 'Təhsil', 'en' => 'Education', 'ru' => 'Образование'],
                'categories' =>
                    [
                        'master' => [
                            'translations' => ['az' => 'Maqistr', 'en' => 'Master degree', 'ru' => 'Степень магистра'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                                'about-mba' => ['az' => 'MBA HAQQINDA', 'en' => 'ABOUT MBA', 'ru' => 'О МВА'],
                                'gead-master-handbook' => ['az' => 'GEAD MAGISTR KITABÇASI', 'en' => 'GEAD MASTER HANDBOOK', 'ru' => 'РУКОВОДСТВО ПО GEAD MASTER'],
                            ]
                        ],
                        'doctorate' => [
                            'translations' => ['az' => 'Doktorantura', 'en' => 'Doctorate', 'ru' => 'Докторантура'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                            ]
                        ],
                        'residency' => [
                            'translations' => ['az' => 'Rezidentura', 'en' => 'Residency', 'ru' => 'Резиденция'],
                            'alt-categories' => [
                                'legal-normative-documents' => ['az' => 'HÜQUQI NORMATIV SƏNƏDLƏR', 'en' => 'LEGAL NORMATIVE DOCUMENTS', 'ru' => 'НОРМАТИВНО-ПРАВОВЫЕ ДОКУМЕНТЫ'],
                                'specialization-keys' => ['az' => 'İXTISAS ŞIFRLƏRI', 'en' => 'SPECIALIZATION Keys', 'ru' => 'ПАРОЛИ СПЕЦИАЛИЗАЦИИ'],
                            ]
                        ],
                    ],
            ],
            'education-abroad' => [
                'translations' => ['az' => 'Xaricdə təhsil', 'en' => 'Education abroad', 'ru' => 'Учеба за границей'],
                'categories' =>
                    [
                        'master' => ['az' => 'Maqistr', 'en' => 'Master degree', 'ru' => 'Степень магистра'],
                        'doctorate' => ['az' => 'Doktorantura', 'en' => 'Doctorate', 'ru' => 'Докторантура'],
                        'residency' => ['az' => 'Rezidentura', 'en' => 'Residency', 'ru' => 'Резиденция'],
                    ],
            ],
            'scientific-activity' => [
                [
                    'translations' => ['az' => 'Elmi fəaliyyət', 'en' => 'Scientific activity', 'ru' => 'Научная деятельность'],
                    'categories' =>
                        [
                            'scientific-research-methods' => ['az' => 'Elmi tədqiqat üsulları', 'en' => 'Scientific research methods', 'ru' => 'Методы научных исследований'],
                            'dissertation-drafting-rules' => ['az' => 'Disertasiyanın tərtibi qaydaları', 'en' => 'Dissertation drafting rules', 'ru' => 'Правила оформления диссертации'],
                            'dissertation-boards' => ['az' => 'Dissertasiya şuraları', 'en' => 'Dissertation boards', 'ru' => 'Диссертационные советы'],
                            'scientific-names' => ['az' => 'Elmi adlar', 'en' => 'Scientific names', 'ru' => 'Научные названия'],
                        ],
                ],
            ],
            'scientific-publications' => [
                'translations' => ['az' => 'Elmi nəşrlər', 'en' => 'Scientific publications', 'ru' => 'Научные публикации'],
                'categories' =>
                    [
                        'internotional-young-researches-journal' =>
                            [
                                'translations' => ['az' => 'Beynəlxalq Gənc Tədqiqatçılar Jurnalı', 'en' => 'İnternotional Young Researches Journal', 'ru' => 'Международный журнал молодых исследователей'],
                                'alt-categories' => ['legal-normative-documents' => ['az' => 'Beynəlxalq Gənc Tədqiqatçılar Jurnalı 1', 'en' => 'İnternotional Young Researches Journal 1', 'ru' => 'Международный журнал молодых исследователей 1']],

                            ],
//                    ],
                        'memory-book-of-doctoral-students' => ['az' => 'Doktorantların yaddaş kitabçası', 'en' => 'Memory book of doctoral students', 'ru' => 'Докторантларин яддаш китабчасы'],
                        'victory-day-collection' => ['az' => 'Zəfər gününə həsr olunmuş gənc tədqiqatçıların elmi məqalələr toplusu', 'en' => 'A collection of scientific articles by young researchers dedicated to Victory Day', 'ru' => 'Сборник научных статей молодых исследователей, посвященный Дню Победы'],
                        'victory-day-collection-2' => ['az' => 'Zəfər gününə həsr olunmuş gənc tədqiqatçıların elmi məqalələr toplusu 2', 'en' => 'A collection of scientific articles by young researchers dedicated to Victory Day 2', 'ru' => 'Сборник научных статей молодых исследователей, посвященный Дню Победы 2'],
                        'akk-recommended-publications' => ['az' => 'AKK-ın tövsiyyə etdiyi nəşrlər', 'en' => 'AKK recommended publications', 'ru' => 'АКК рекомендуемые публикации'],
                        'scientific-publications-of-our-members' => ['az' => 'Üzvlərimizin elmi nəşrləri', 'en' => 'Scientific publications of our members', 'ru' => 'Научные публикации наших участников'],
                        'gead-scientific-compendium' => ['az' => 'GEAD elmi məcmusu', 'en' => 'GEAD scientific compendium', 'ru' => 'Научный сборник GEAD'],
                        'international-indexed-journals' => [
                            'translations' => ['az' => 'Beynəlxalq indeksli jurnallar'], ['en' => 'International indexed journals'], ['ru' => 'Международные индексируемые журналы'],
                            'alt-categories' => [
                                'exact-sciences' => ['az' => 'Dəqiq elmlər', 'en' => 'Exact sciences', 'ru' => 'Точные науки'],
                                'social-sciences' => ['az' => 'Sosial elmlər', 'en' => 'Social sciences', 'ru' => 'Социальные науки'],
                                'humanities' => ['az' => 'Humanitar elmlər', 'en' => 'Humanities', 'ru' => 'Гуманитарные науки'],
                            ]
                        ],
                        'links-to-foreign-scientific-journals' => ['az' => 'Xarici elmi jurnalların linkləri', 'en' => 'Links to foreign scientific journals', 'ru' => 'Ссылки на зарубежные научные журналы'],
                    ],
            ],
            'library' => [
                'translations' => ['az' => 'Kitabxana', 'en' => 'Library', 'ru' => 'Библиотека'],
                'categories' =>
                    [
                        'new-books' => ['az' => 'Yeni kitablar', 'en' => 'New books', 'ru' => 'Новые книги'],
                        'library-of-gead-pu' => ['az' => 'GEAD İB-nin kitabxanası', 'en' => 'Library of GEAD PU', 'ru' => 'Библиотека GEAD PU'],
                        'links-to-libraries' => ['az' => 'Kitabxanalara linklər', 'en' => 'Links to libraries', 'ru' => 'Ссылки на библиотеки'],
                        'international-libraries' => ['az' => 'Beynəlxalq kitabxanalar', 'en' => 'International libraries', 'ru' => 'Международные библиотеки'],
                    ],
            ],
            'projects' => [
                'translations' => ['az' => 'Layihələr', 'en' => 'Projects', 'ru' => 'Проекты'],
                'categories' =>
                    [
                        'new-books' => ['az' => 'İcra olunmuş layihələr', 'en' => 'Completed projects', 'ru' => 'Завершенные проекты'],
                        'ongoing-projects' => ['az' => 'Davam edən layihələr', 'en' => 'Ongoing projects', 'ru' => 'Текущие проекты'],
                        'grant-competition' => ['az' => 'Qrant müsabiqəsi', 'en' => 'Grant competition', 'ru' => 'Грантовый конкурс'],
                        'rules-for-writing-projects' => ['az' => 'Layihələrin yazılma qaydaları', 'en' => 'Rules for writing projects', 'ru' => 'Правила написания проектов'],
                    ],
            ],
            'news' => [
                'translations' => ['az' => 'Xəbərlər', 'en' => 'News', 'ru' => 'Новости'],
                'categories' =>
                    [
                        'new-books' => ['az' => 'Elmi yeniliklər', 'en' => 'Completed projects', 'ru' => 'Завершенные проекты'],
                        'local-news' => ['az' => 'Yerli xəbərlər', 'en' => 'Local news', 'ru' => 'Местные новости'],
                        'foreign-news' => ['az' => 'Xarici xəbərlər', 'en' => 'Foreign news', 'ru' => 'Зарубежные новости'],

                    ],
            ],
            'advertisements' => [
                'translations' => ['az' => 'Elanlar', 'en' => 'Advertisements', 'ru' => 'Объявления'],
                'categories' =>
                    [
                        'education' => ['az' => 'Təhsil', 'en' => 'Education', 'ru' => 'Образование'],
                        'seminars' => ['az' => 'Seminarlar', 'en' => 'Seminars', 'ru' => 'Семинары'],
                        'conferences-and-symposia' => ['az' => 'Konferans və Simpoziumlar', 'en' => 'Conferences and Symposia', 'ru' => 'Конференции и симпозиумы'],
                        'competitions' => ['az' => 'Müsabiqələr', 'en' => 'Competitions', 'ru' => 'Соревнования'],
                        'vacancies' => ['az' => 'Vakansiyalar', 'en' => 'Vacancies', 'ru' => 'Вакансии'],
                    ],
            ],
        ];
//        foreach ($categories as $key => $category){
//
//        }
//        dd($categories);
        dd($categories['education-abroad']);
        $products = Product::get()->take(5);
        return view('login', get_defined_vars());
    }

    public function search(Request $request)
    {

    }

    public function newsletter(Request $request)
    {
//        try {
        $validator = Validator::make($request->all(), [
            'newsletterEmail' => 'unique:newsletter|required|max:255',
        ]);
        $subscriber = Newsletter::create([
            'mail' => $request->newsletterEmail,
            'token' => md5(time()),
            'status' => 0,
        ]);
        $data = [
            'id' => $subscriber->id,
            'mail' => $subscriber->mail,
            'token' => $subscriber->token,
        ];
        Mail::send('backend.mail.newsletter', $data, function ($message) use ($subscriber) {
            $message->to($subscriber->mail);
            $message->subject('Email adresinizi təsdiq edin!');
        });
//            return redirect()->back()->with('successMessage', __('messages.success'));
//        } catch (Exception $e) {
//            return redirect()->back()->with('errorMessage', __('messages.error'));
//        }
    }

    public function verifyMail($id, $token)
    {
        $subscriber = Newsletter::find($id);
        if ($subscriber->token == $token) {
            $subscriber->update([
                'status' => 1,
            ]);
            return view('frontend.includes.mail');
        }
    }

    public function createOrder()
    {
        return view('frontend.order.index');
    }

    public function newOrder(Request $request)
    {
        try {
            $receiver = settings('mail_receiver');
            $order = new Order();
            $order->name = $request->name;
            $order->surname = $request->surname;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->order = $request->order;
            $order->save();
            $data = [
                'name' => $order->name,
                'surname' => $order->surname,
                'email' => $order->email,
                'phone' => $order->phone,
                'order' => $order->order
            ];
            Mail::send('backend.mail.order', $data, function ($message) use ($receiver) {
                $message->to($receiver);
                $message->subject(__('backend.you-have-new-order'));
            });
            alert()->success(__('messages.success'));
            return redirect(route('frontend.createOrder'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('frontend.createOrder'));
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $receiver = settings('mail_receiver');
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->surname = $request->surname;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->read_status = 0;
            $contact->message = $request->order;
            $contact->save();
            $data = [
                'name' => $contact->name,
                'surname' => $contact->surname,
                'email' => $contact->email,
                'subject' => $contact->subject,
                'msg' => $contact->message
            ];
            Mail::send('backend.mail.send', $data, function ($message) use ($receiver) {
                $message->to($receiver);
                $message->subject(__('backend.you-have-new-message'));
            });
            alert()->success(__('messages.success'));
            return redirect(route('frontend.contact-us-page'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('frontend.contact-us-page'));
        }
    }
}

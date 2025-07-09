<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'active_type' => 'nullable|string',
            'trip_type' => 'required|string',
            'cabin_class' => 'required|string',
            'passengers' => 'required|array',
            'passengers.adult' => 'required|integer|min:1',
            'passengers.child' => 'required|integer|min:0',
            'passengers.infant' => 'required|integer|min:0',
            'client' => 'required|array',
            'client.name' => 'required|string|max:255',
            'client.email' => 'required|email|max:255',
            'client.phone' => 'required|string|max:255',
            'flights' => 'required|array',
            'flights.*.from' => 'required|string|size:3',
            'flights.*.to' => 'required|string|size:3',
            'flights.*.date' => 'required|date',
            'preferences' => 'required|array',
            'preferences.quotes_via_sms' => 'required|boolean',
            'timezone' => 'required|string'
        ]);

        $requestData = $request->all();

        $message = "
*🛫 НОВАЯ ЗАЯВКА НА ПОИСК АВИАБИЛЕТОВ* 🛬

*📋 Основная информация:*";

        if (isset($requestData['active_type'])) {
            $message .= "
• *Тип активности:* `" . $requestData['active_type'] . "`";
        }

        $message .= "
• *Тип поездки:* `" . $requestData['trip_type'] . "`
• *Класс обслуживания:* `" . $requestData['cabin_class'] . "`

*👥 Пассажиры:*
• Взрослых: `" . $requestData['passengers']['adult'] . "` 👨‍👩‍👧‍👦
• Детей: `" . $requestData['passengers']['child'] . "` 👶
• Младенцев: `" . $requestData['passengers']['infant'] . "` 🍼

*👤 Информация о клиенте:*
• *Имя:* `" . $requestData['client']['name'] . "`
• *Email:* `" . $requestData['client']['email'] . "`
• *Телефон:* `" . $requestData['client']['phone'] . "`

*✈️ Маршрут:*";

        foreach ($requestData['flights'] as $index => $flight) {
            $message .= "
*Рейс " . ($index + 1) . ":*
• Откуда: `" . $flight['from'] . "` 🛫
• Куда: `" . $flight['to'] . "` 🛬
• Дата: `" . $flight['date'] . "` 📅";
        }

        $message .= "

*⚙️ Дополнительные настройки:*
• Получать предложения по SMS: " . ($requestData['preferences']['quotes_via_sms'] ? "✅" : "❌") . "
• Часовой пояс: `" . $requestData['timezone'] . "` 🌍";

        $telegramService = new TelegramService();
        $telegramService->sendMessage(env('TELEGRAM_CHAT_ID'), $message);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => Str::random(24),
                'event' => 'non_us_lead_created'
            ]
        ]);
    }

    public function redirects(Request $request)
    {
        return response()->json([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'page' => 1,
                    'pageSize' => 25,
                    'pageCount' => 0,
                    'total' => 0
                ]
            ]
        ]);
    }


    public function pageResultsMain(Request $request)
    {
        return response()->json([
            "data" => [
                "id" => 5,
                "attributes" => [
                    "title" => "Fly Business | Home",
                    "metaDescription" => "Fly Business is an online travel agency that offers massively discounted airfares to flights across the world, Get online or call us now for a quote!",
                    "header" => null,
                    "subheader" => null,
                    "slug" => "/",
                    "createdAt" => "2024-06-21T17:31:48.095Z",
                    "updatedAt" => "2024-06-21T18:47:28.322Z",
                    "publishedAt" => "2024-06-21T17:32:16.516Z",
                    "blocks" => [
                        [
                            "id" => 1,
                            "__component" => "sections.welcome"
                        ],
                        [
                            "id" => 155,
                            "__component" => "sections.numbers"
                        ],
                        [
                            "id" => 161,
                            "__component" => "sections.how-does-this-work"
                        ],
                        [
                            "id" => 1,
                            "__component" => "sections.accreditations"
                        ],
                        [
                            "id" => 155,
                            "__component" => "sections.why-to-book"
                        ],
                        [
                            "id" => 154,
                            "__component" => "sections.best-deals",
                            "items" => [
                                [
                                    "id" => 919,
                                    "page" => [
                                        "data" => [
                                            "id" => 151,
                                            "attributes" => [
                                                "title" => "Discount Business Class Tickets Europe",
                                                "metaDescription" => "Fly Business is an online and over-the-phone travel agency that deals in sales of discounted airline tickets all over the world including Europe",
                                                "type" => "region",
                                                "cabinClass" => "business",
                                                "name" => "Europe",
                                                "price" => 1995,
                                                "oldPrice" => 2254,
                                                "slug" => "/business-class/europe",
                                                "createdAt" => "2024-06-21T17:02:12.367Z",
                                                "updatedAt" => "2024-07-04T18:22:58.668Z",
                                                "publishedAt" => "2024-06-21T17:02:12.348Z",
                                                "heroBgLarge" => [
                                                    "data" => [
                                                        "id" => 454,
                                                        "attributes" => [
                                                            "name" => "Europe_C_1_2K.jpg",
                                                            "alternativeText" => null,
                                                            "caption" => null,
                                                            "width" => 2048,
                                                            "height" => 1080,
                                                            "formats" => [
                                                                "large" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/large_Europe_C_1_2_K_12be3a3680/large_Europe_C_1_2_K_12be3a3680.jpg",
                                                                    "hash" => "large_Europe_C_1_2_K_12be3a3680",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "large_Europe_C_1_2K.jpg",
                                                                    "path" => null,
                                                                    "size" => 124,
                                                                    "width" => 1000,
                                                                    "height" => 527,
                                                                    "sizeInBytes" => 124001
                                                                ],
                                                                "small" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/small_Europe_C_1_2_K_12be3a3680/small_Europe_C_1_2_K_12be3a3680.jpg",
                                                                    "hash" => "small_Europe_C_1_2_K_12be3a3680",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "small_Europe_C_1_2K.jpg",
                                                                    "path" => null,
                                                                    "size" => 34.51,
                                                                    "width" => 500,
                                                                    "height" => 264,
                                                                    "sizeInBytes" => 34509
                                                                ],
                                                                "medium" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/medium_Europe_C_1_2_K_12be3a3680/medium_Europe_C_1_2_K_12be3a3680.jpg",
                                                                    "hash" => "medium_Europe_C_1_2_K_12be3a3680",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "medium_Europe_C_1_2K.jpg",
                                                                    "path" => null,
                                                                    "size" => 73.54,
                                                                    "width" => 750,
                                                                    "height" => 396,
                                                                    "sizeInBytes" => 73537
                                                                ],
                                                                "thumbnail" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/thumbnail_Europe_C_1_2_K_12be3a3680/thumbnail_Europe_C_1_2_K_12be3a3680.jpg",
                                                                    "hash" => "thumbnail_Europe_C_1_2_K_12be3a3680",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "thumbnail_Europe_C_1_2K.jpg",
                                                                    "path" => null,
                                                                    "size" => 9.67,
                                                                    "width" => 245,
                                                                    "height" => 129,
                                                                    "sizeInBytes" => 9666
                                                                ]
                                                            ],
                                                            "hash" => "Europe_C_1_2_K_12be3a3680",
                                                            "ext" => ".jpg",
                                                            "mime" => "image/jpeg",
                                                            "size" => 427.34,
                                                            "url" => "https://static-cdn.fly.business/v/fb/wuploads/Europe_C_1_2_K_12be3a3680/Europe_C_1_2_K_12be3a3680.jpg",
                                                            "previewUrl" => null,
                                                            "provider" => "@strapi-community/strapi-provider-upload-google-cloud-storage",
                                                            "provider_metadata" => null,
                                                            "createdAt" => "2024-05-29T19:53:07.233Z",
                                                            "updatedAt" => "2024-05-29T19:53:07.233Z"
                                                        ]
                                                    ]
                                                ],
                                                "heroBgMedium" => [
                                                    "data" => [
                                                        "id" => 455,
                                                        "attributes" => [
                                                            "name" => "Europe_C_1_Tablet.jpg",
                                                            "alternativeText" => null,
                                                            "caption" => null,
                                                            "width" => 1024,
                                                            "height" => 728,
                                                            "formats" => [
                                                                "large" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/large_Europe_C_1_Tablet_56b6eba507/large_Europe_C_1_Tablet_56b6eba507.jpg",
                                                                    "hash" => "large_Europe_C_1_Tablet_56b6eba507",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "large_Europe_C_1_Tablet.jpg",
                                                                    "path" => null,
                                                                    "size" => 169.05,
                                                                    "width" => 1000,
                                                                    "height" => 711,
                                                                    "sizeInBytes" => 169047
                                                                ],
                                                                "small" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/small_Europe_C_1_Tablet_56b6eba507/small_Europe_C_1_Tablet_56b6eba507.jpg",
                                                                    "hash" => "small_Europe_C_1_Tablet_56b6eba507",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "small_Europe_C_1_Tablet.jpg",
                                                                    "path" => null,
                                                                    "size" => 47.28,
                                                                    "width" => 500,
                                                                    "height" => 355,
                                                                    "sizeInBytes" => 47277
                                                                ],
                                                                "medium" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/medium_Europe_C_1_Tablet_56b6eba507/medium_Europe_C_1_Tablet_56b6eba507.jpg",
                                                                    "hash" => "medium_Europe_C_1_Tablet_56b6eba507",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "medium_Europe_C_1_Tablet.jpg",
                                                                    "path" => null,
                                                                    "size" => 101.29,
                                                                    "width" => 750,
                                                                    "height" => 533,
                                                                    "sizeInBytes" => 101291
                                                                ],
                                                                "thumbnail" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/thumbnail_Europe_C_1_Tablet_56b6eba507/thumbnail_Europe_C_1_Tablet_56b6eba507.jpg",
                                                                    "hash" => "thumbnail_Europe_C_1_Tablet_56b6eba507",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "thumbnail_Europe_C_1_Tablet.jpg",
                                                                    "path" => null,
                                                                    "size" => 10.02,
                                                                    "width" => 219,
                                                                    "height" => 156,
                                                                    "sizeInBytes" => 10023
                                                                ]
                                                            ],
                                                            "hash" => "Europe_C_1_Tablet_56b6eba507",
                                                            "ext" => ".jpg",
                                                            "mime" => "image/jpeg",
                                                            "size" => 180.38,
                                                            "url" => "https://static-cdn.fly.business/v/fb/wuploads/Europe_C_1_Tablet_56b6eba507/Europe_C_1_Tablet_56b6eba507.jpg",
                                                            "previewUrl" => null,
                                                            "provider" => "@strapi-community/strapi-provider-upload-google-cloud-storage",
                                                            "provider_metadata" => null,
                                                            "createdAt" => "2024-05-29T19:53:14.118Z",
                                                            "updatedAt" => "2024-05-29T19:53:14.118Z"
                                                        ]
                                                    ]
                                                ],
                                                "heroBgSmall" => [
                                                    "data" => [
                                                        "id" => 453,
                                                        "attributes" => [
                                                            "name" => "Europe_C_1_Mobile.jpg",
                                                            "alternativeText" => null,
                                                            "caption" => null,
                                                            "width" => 414,
                                                            "height" => 1080,
                                                            "formats" => [
                                                                "large" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/large_Europe_C_1_Mobile_1a3333ec49/large_Europe_C_1_Mobile_1a3333ec49.jpg",
                                                                    "hash" => "large_Europe_C_1_Mobile_1a3333ec49",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "large_Europe_C_1_Mobile.jpg",
                                                                    "path" => null,
                                                                    "size" => 67.04,
                                                                    "width" => 383,
                                                                    "height" => 1000,
                                                                    "sizeInBytes" => 67044
                                                                ],
                                                                "small" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/small_Europe_C_1_Mobile_1a3333ec49/small_Europe_C_1_Mobile_1a3333ec49.jpg",
                                                                    "hash" => "small_Europe_C_1_Mobile_1a3333ec49",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "small_Europe_C_1_Mobile.jpg",
                                                                    "path" => null,
                                                                    "size" => 18.96,
                                                                    "width" => 192,
                                                                    "height" => 500,
                                                                    "sizeInBytes" => 18956
                                                                ],
                                                                "medium" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/medium_Europe_C_1_Mobile_1a3333ec49/medium_Europe_C_1_Mobile_1a3333ec49.jpg",
                                                                    "hash" => "medium_Europe_C_1_Mobile_1a3333ec49",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "medium_Europe_C_1_Mobile.jpg",
                                                                    "path" => null,
                                                                    "size" => 40.08,
                                                                    "width" => 288,
                                                                    "height" => 750,
                                                                    "sizeInBytes" => 40076
                                                                ],
                                                                "thumbnail" => [
                                                                    "ext" => ".jpg",
                                                                    "url" => "https://static-cdn.fly.business/v/fb/wuploads/thumbnail_Europe_C_1_Mobile_1a3333ec49/thumbnail_Europe_C_1_Mobile_1a3333ec49.jpg",
                                                                    "hash" => "thumbnail_Europe_C_1_Mobile_1a3333ec49",
                                                                    "mime" => "image/jpeg",
                                                                    "name" => "thumbnail_Europe_C_1_Mobile.jpg",
                                                                    "path" => null,
                                                                    "size" => 2.57,
                                                                    "width" => 60,
                                                                    "height" => 156,
                                                                    "sizeInBytes" => 2568
                                                                ]
                                                            ],
                                                            "hash" => "Europe_C_1_Mobile_1a3333ec49",
                                                            "ext" => ".jpg",
                                                            "mime" => "image/jpeg",
                                                            "size" => 78.22,
                                                            "url" => "https://static-cdn.fly.business/v/fb/wuploads/Europe_C_1_Mobile_1a3333ec49/Europe_C_1_Mobile_1a3333ec49.jpg",
                                                            "previewUrl" => null,
                                                            "provider" => "@strapi-community/strapi-provider-upload-google-cloud-storage",
                                                            "provider_metadata" => null,
                                                            "createdAt" => "2024-05-29T19:53:20.158Z",
                                                            "updatedAt" => "2024-05-29T19:53:20.158Z"
                                                        ]
                                                    ]
                                                ],
                                                "blocks" => [
                                                    [
                                                        "id" => 151,
                                                        "__component" => "sections.best-deals"
                                                    ],
                                                    [
                                                        "id" => 157,
                                                        "__component" => "sections.how-does-this-work"
                                                    ],
                                                    [
                                                        "id" => 150,
                                                        "__component" => "sections.why-to-book"
                                                    ],
                                                    [
                                                        "id" => 150,
                                                        "__component" => "sections.numbers"
                                                    ],
                                                    [
                                                        "id" => 157,
                                                        "__component" => "sections.free-content",
                                                        "header" => null,
                                                        "subheader" => null,
                                                        "content" => "<h2>Fly Business offers cheap business class tickets to destinations in Europe</h2><p><br></p><p>Embark on an unmatched journey with business class flights tailored for the discerning traveler. At Fly Business, the premier business travel agency, we are your trusted gateway to a world of comfort and affordable business flights. Our agents tirelessly negotiate with leading business class airlines and business class consolidators to bring you the cheapest business class flights and discount business class tickets to various destinations including the captivating continents of Europe, Asia, Africa, Australia, Oceania, India, North America and others. </p><p>Dive into the world of affordable luxury with our cheap business class flights. We pride ourselves on securing the best business class flight deals, connecting you to your destination with comfort and style. Whether you're a seasoned traveler or embarking on a new adventure, our exclusive offers on business class flight tickets are designed to cater to your every need.</p><p>Experience the luxury of a business class flight and enjoy the myriad benefits that come with it, especially for long-haul journeys. With priority check-in and boarding, generous baggage allowances, and spacious, comfortable seats, flight business class promises an unparalleled travel experience. Enjoy a higher quality of meals and onboard entertainment that would transform your journey into a delightful adventure.</p><p>Discover the beauty of Europe with cheap business class tickets to Europe, offering an experience of comfort and luxury without the hefty price tag. Our collection of business class tickets guarantees a journey where comfort meets sophistication. And with the current sale, we are offering up to 60% off, providing a golden opportunity to secure cheap business class tickets for your next trip.</p><p>Fly Business is your go-to business travel agency for securing exclusive deals and offers that redefine air travel. Our dedication and expertise make us a trusted choice for travelers seeking the finest business class travel experiences.</p><p>Book now and step into a world of unparalleled luxury and convenience, without breaking the bank.</p><p><br></p>"
                                                    ],
                                                    [
                                                        "id" => 246,
                                                        "__component" => "sections.assistance"
                                                    ]
                                                ],
                                                "priceTableItems" => [
                                                    [
                                                        "id" => 362,
                                                        "fallbackName" => null,
                                                        "fallbackPrice" => null,
                                                        "fallbackOldPrice" => null
                                                    ],
                                                    [
                                                        "id" => 363,
                                                        "fallbackName" => null,
                                                        "fallbackPrice" => null,
                                                        "fallbackOldPrice" => null
                                                    ],
                                                    [
                                                        "id" => 364,
                                                        "fallbackName" => null,
                                                        "fallbackPrice" => null,
                                                        "fallbackOldPrice" => null
                                                    ],
                                                    [
                                                        "id" => 365,
                                                        "fallbackName" => null,
                                                        "fallbackPrice" => null,
                                                        "fallbackOldPrice" => null
                                                    ],
                                                    [
                                                        "id" => 366,
                                                        "fallbackName" => null,
                                                        "fallbackPrice" => null,
                                                        "fallbackOldPrice" => null
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                // ... (other best-deals items omitted for brevity, but should be included in real code)
                            ]
                        ],
                        [
                            "id" => 10,
                            "__component" => "sections.assistance"
                        ]
                    ]
                ]
            ],
            "meta" => (object)[]
        ]);
    }

    public function pageResults(Request $request, $page) {
        return response()->json([
            'data' => [
                'id' => 1,
                'attributes' => [
                    'title' => 'Luxury Airways | Results',
                    'metaDescription' => 'Luxury Airways is an online travel agency that offers massively discounted airfares to flights across the world, Get online or call us now for a quote!',
                    'header' => null,
                    'subheader' => null,
                    'slug' => '/results',
                    'createdAt' => '2024-06-21T17:17:29.908Z',
                    'updatedAt' => '2024-11-13T13:08:25.275Z',
                    'publishedAt' => '2024-06-21T17:17:30.764Z',
                    'blocks' => []
                ]
            ],
            'meta' => [
            ]
        ]);
    }

    public function contacts(Request $request)
{
    $requestData = $request->all();

    $message = "
📩 *НОВОЕ СООБЩЕНИЕ С КОНТАКТНОЙ ФОРМЫ*

• *Имя:* `" . ($requestData['name'] ?? 'не указано') . "`
• *Email:* `" . ($requestData['email'] ?? 'не указано') . "`
• *Телефон:* `" . ($requestData['phone'] ?? 'не указано') . "`
• *Сообщение:* `" . ($requestData['message'] ?? 'не указано') . "`";

    // Доп. данные (необязательно, можно убрать если не нужно)
    if (isset($requestData['_cp'])) {
        $message .= "\n• *Источник:* `" . $requestData['_cp'] . "`";
    }
    if (isset($requestData['_gacid'])) {
        $message .= "\n• *GA Client ID:* `" . $requestData['_gacid'] . "`";
    }
    if (isset($requestData['_roistat'])) {
        $message .= "\n• *Roistat:* `" . $requestData['_roistat'] . "`";
    }

    $telegramService = new TelegramService();
    $telegramService->sendMessage(env('TELEGRAM_CHAT_ID'), $message);

    return response()->json([
        'success' => true,
        'message' => 'Контактные данные успешно отправлены.'
    ]);
}

}

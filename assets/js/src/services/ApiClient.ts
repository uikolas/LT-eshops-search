class ApiClient {
    public get(url) {
        return JSON.parse(`
            {
                "data": [
                    {
                        "name": "PowerMax Car Charger PPC006 12-24V>5V 2A for iPhone, iPad, iPod Powermax",
                        "image": "https:\\/\\/www.kilobaitas.lt\\/Pub\\/ShowImage.aspx?itemID=ACME_073050&image=440x440&h=125&w=175&errorImage=\\/Images\\/design\\/noImage.gif",
                        "price": "0,86\u00a0\u20ac",
                        "url": "\\/Priedai\\/Powerman\\/PowerMax_Car_Charger_PPC006_12\\/PPC006\\/CatalogStoreDetail.aspx?CatID=PL_572&ID=356519",
                        "shop": "Kilobaitas"
                    },
                    {
                        "name": "Permatoma \u012fmaut\u0117 iBOX iPhone 4 ir 4s",
                        "image": "https:\\/\\/www.kilobaitas.lt\\/Pub\\/ShowImage.aspx?itemID=ABCDATA_C3125320&image=C3125320&h=125&w=175&errorImage=\\/Images\\/design\\/noImage.gif",
                        "price": "0,89\u00a0\u20ac",
                        "url": "\\/Mobiliu_telefonu_priedai\\/IBOX\\/Permatoma_imaute_iBOX_iPhone_4\\/IIP001\\/CatalogStoreDetail.aspx?CatID=PL_554&ID=454681",
                        "shop": "Kilobaitas"
                    },
                    {
                        "name": "Silikonin\u0117 \u012fmaut\u0117 iBOX iPhone 4 ir 4s",
                        "image": "https:\\/\\/www.kilobaitas.lt\\/Pub\\/ShowImage.aspx?itemID=ABCDATA_C3125319&image=C3125319&h=125&w=175&errorImage=\\/Images\\/design\\/noImage.gif",
                        "price": "0,89\u00a0\u20ac",
                        "url": "\\/Mobiliu_telefonu_priedai\\/IBOX\\/Silikonine_imaute_iBOX_iPhone_\\/IIP002\\/CatalogStoreDetail.aspx?CatID=PL_554&ID=454680",
                        "shop": "Kilobaitas"
                    },
                    {
                        "name": "KSIX B0938SC07 Screen protector, Apple, iPhone 8, Tempered glass 9H, Transparent",
                        "image": "https:\\/\\/www.kilobaitas.lt\\/Pub\\/ShowImage.aspx?itemID=ACME_209574&image=440x440&h=125&w=175&errorImage=\\/Images\\/design\\/noImage.gif",
                        "price": "3,19\u00a0\u20ac",
                        "url": "\\/Mobiliu_telefonu_priedai\\/KSIX\\/KSIX_B0938SC07_Screen_protecto\\/B0938SC07\\/CatalogStoreDetail.aspx?CatID=PL_554&ID=732081",
                        "shop": "Kilobaitas"
                    }
                ],
                "total": 143
            }
        `)
    }
}

export default new ApiClient();
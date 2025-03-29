const listings = [
    // Switch Modular and Luxury
    {
        title: "Polycab Luxury Switch",
        description: "High-end modular switch with sleek design.",
        category: "Switch Modular and Luxury",
        price: 25.99,
        image: "https://plus.unsplash.com/premium_photo-1729260386557-d3b7ec43072e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8aW90JTIwc3dpdGNofGVufDB8fDB8fHww"
    },
    {
        title: "Zencelo Full Flat Switch",
        description: "Stylish flat switch for modern homes.",
        category: "Switch Modular and Luxury",
        price: 30.50,
        image: "https://media.istockphoto.com/id/1304592918/photo/fashionable-modern-silver-light-switches-on-a-gray-wall-opposite-view-switch-with-night.webp?a=1&b=1&s=612x612&w=0&k=20&c=lgWFVPA8zcbh4YjmvBOLxaIp4B8UqVdWmYk650n-p-M="
    },
    {
        title: "Schneider Unica Pure",
        description: "Premium switch series with customizable options.",
        category: "Switch Modular and Luxury",
        price: 45.00,
        image: "https://plus.unsplash.com/premium_photo-1723867368575-75f60b784a98?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8aW90JTIwc3dpdGNofGVufDB8fDB8fHww"
    },
    
    // Wires
    {
        title: "Polycab Copper Wire",
        description: "High-quality copper wire for safe electrical connections.",
        category: "Wires",
        price: 10.99,
        image: "https://images.unsplash.com/photo-1564970173067-36ccde5c467b?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aW90JTIwd2lyZXN8ZW58MHx8MHx8fDA%3D"
    },
    {
        title: "Schneider Electric Wire",
        description: "Durable and flexible wiring for residential and commercial use.",
        category: "Wires",
        price: 12.50,
        image: "https://plus.unsplash.com/premium_photo-1675024226990-36dcb7252c62?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8aW90JTIwd2lyZXN8ZW58MHx8MHx8fDA%3D"
    },
    {
        title: "Miluz Zeta Wire",
        description: "High-performance wiring for industrial applications.",
        category: "Wires",
        price: 15.75,
        image: "https://images.unsplash.com/photo-1518181835702-6eef8b4b2113?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8d2lyZXxlbnwwfHwwfHx8MA%3D%3D"
    },
    
    // Camera Dom and Bullet
    {
        title: "Hikvision Dome Camera",
        description: "High-definition security dome camera with night vision.",
        category: "Camera Dom and Bullet",
        price: 99.99,
        image: "https://images.unsplash.com/photo-1495121553079-4c61bcce1894?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8SGlrdmlzaW9uJTIwRG9tZSUyMENhbWVyYSUyMnxlbnwwfHwwfHx8MA%3D%3D"
    },
    {
        title: "CP Plus Bullet Camera",
        description: "Weatherproof bullet camera for outdoor security.",
        category: "Camera Dom and Bullet",
        price: 120.50,
        image: "https://images.unsplash.com/photo-1728971568218-03a7f87c9e99?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aW90JTIwY2FtZXJhfGVufDB8fDB8fHww"
    },
    {
        title: "Dahua IR Dome Camera",
        description: "Infrared dome camera with motion detection.",
        category: "Camera Dom and Bullet",
        price: 130.75,
        image: "https://plus.unsplash.com/premium_photo-1729580056441-6ab34fe19d3d?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8aW90JTIwY2FtZXJhfGVufDB8fDB8fHww"
    },
    

    
    // Motorised Gate and Curtain
    {
        title: "FAAC Motorised Gate",
        description: "Automatic gate system for residential security.",
        category: "Motorised Gate and Curtain",
        price: 499.99,
        image: "https://images.unsplash.com/photo-1473252812967-d565c3607e28?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
    },
    {
        title: "Somfy Motorised Curtain",
        description: "Smart curtain system with remote control.",
        category: "Motorised Gate and Curtain",
        price: 150.00,
        image: "https://images.unsplash.com/photo-1598414381594-18d86505f5d5?w=400&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDF8fHxlbnwwfHx8fHw%3D"
    },
    {
        title: "Nice Sliding Gate Motor",
        description: "Heavy-duty motor for sliding gates.",
        category: "Motorised Gate and Curtain",
        price: 599.99,
        image: "https://images.unsplash.com/photo-1509644851169-2acc08aa25b5?w=400&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDEzfHx8ZW58MHx8fHx8"
    },
    
    // Home Theater and Audio
    {
        title: "Bose Home Theater",
        description: "Premium surround sound system for a cinematic experience.",
        category: "Home Theater and Audio",
        price: 999.99,
        image: "https://plus.unsplash.com/premium_photo-1675615667883-38c070716700?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aG9tZSUyMHRoZWF0ZXJ8ZW58MHx8MHx8fDA%3D"
    },
    {
        title: "Sony Soundbar",
        description: "High-definition soundbar with deep bass.",
        category: "Home Theater and Audio",
        price: 299.99,
        image: "https://images.unsplash.com/photo-1545454675-3531b543be5d?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c3BlYWtlcnxlbnwwfHwwfHx8MA%3D%3D"
    },
    {
        title: "JBL Party Speaker",
        description: "Portable speaker with powerful sound output.",
        category: "Home Theater and Audio",
        price: 199.99,
        image: "https://images.unsplash.com/photo-1687772424499-21363b114191?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amJsJTIwcGFydHklMjBzcGVha2VyfGVufDB8fDB8fHww"
    },
    
    // Fans
    {
        title: "Polycab Ceiling Fan",
        description: "Energy-efficient ceiling fan with stylish design.",
        category: "Fans",
        price: 59.99,
        image: "https://media.istockphoto.com/id/1560120367/photo/ceiling-fan.webp?a=1&b=1&s=612x612&w=0&k=20&c=UwCmwzQfjsWIGsUGMk-RK3vmdOLyGQwF6w1yHWeVJ-4="
    },
    {
        title: "Havells Table Fan",
        description: "Compact and powerful table fan.",
        category: "Fans",
        price: 45.50,
        image: "https://plus.unsplash.com/premium_photo-1699544799817-25c2a274f867?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW90JTIwY2VsaW5nJTIwZmFufGVufDB8fDB8fHww"
    },
    {
        title: "Crompton Wall Fan",
        description: "Wall-mounted fan with adjustable speed settings.",
        category: "Fans",
        price: 39.99,
        image: "https://media.istockphoto.com/id/534366371/photo/broken-old-celling-fan-in-abandoned-building-hanging-from-ceiling.webp?a=1&b=1&s=612x612&w=0&k=20&c=NYyRHmbpM8I-rGXrFHlpVu_D3S5z854zKYCLghMDI4Y="
    },
    
    // Solar Panel
    {
        title: "Luminous Solar Panel",
        description: "Efficient solar panel for sustainable energy.",
        category: "Solar Panel",
        price: 399.99,
        image: "https://images.unsplash.com/photo-1509391366360-2e959784a276?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aW90JTIwRWxlY3RyaWNhbCUyMHBhbmVsfGVufDB8fDB8fHww"
    },
    {
        title: "Tata Power Solar",
        description: "High-performance solar panels for commercial use.",
        category: "Solar Panel",
        price: 499.99,
        image: "https://images.unsplash.com/photo-1520876566265-efab099b229d?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8aW90JTIwRWxlY3RyaWNhbCUyMHBhbmVsfGVufDB8fDB8fHww"
    },
    {
        title: "Adani Rooftop Solar Panel",
        description: "Rooftop solar panel for home installations.",
        category: "Solar Panel",
        price: 599.99,
        image: "https://images.unsplash.com/photo-1536408745983-0f03be6e8a00?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGlvdCUyMEVsZWN0cmljYWwlMjBwYW5lbHxlbnwwfHwwfHx8MA%3D%3D"
    }
];

export default listings;

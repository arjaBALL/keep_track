export const navItems = [
    {
        section: "Main",
        items: [
            {
                label: "Dashboard",
                icon: "dashboard",
                href: "/dashboard",
                badge: null,
            },
            {
                label: "ICT PPE",
                icon: "boxstacked",
                href: "/request-trip-ticket",
                badge: null,
            },
        ],
    },
    {
        section: "PPE",
        items: [
            {
                label: "Fund Classification",
                icon: "bell",
                href: "/incoming-queue",
                badge: 5,
            },
            {
                label: "Property Identification",
                icon: "bell",
                href: "/assign-review",
                badge: null,
            },
            {
                label: "Description Aquisition",
                icon: "bell",
                href: "/assign-review",
                badge: null,
            },
        ],
    },
    {
        section: "Data Management",
        items: [
            {
                label: "Data Management",
                icon: "database",
                children: [
                    {
                        label: "User",
                        icon: "userPlus",
                        href: "/users",
                        badge: null,
                    },
                    {
                        label: "Role",
                        icon: "usertag",
                        href: "/vehicles",
                        badge: null,
                    },
                    {
                        label: "Fund",
                        icon: "moneybill",
                        href: "/drivers",
                        badge: null,
                    },
                    {
                        label: "Account Code",
                        icon: "barcode",
                        href: "/drivers",
                        badge: null,
                    },
                    {
                        label: "Property Class",
                        icon: "tags",
                        href: "/drivers",
                        badge: null,
                    },
                    {
                        label: "Property Type",
                        icon: "shapes",
                        href: "/drivers",
                        badge: null,
                    },
                    {
                        label: "Responsibility Center",
                        icon: "responsibilityCenter",
                        href: "/responsibility-centers",
                        badge: null,
                    },
                    {
                        label: "Status",
                        icon: "status",
                        href: "/statuses",
                        badge: null,
                    },
                    {
                        label: "Location",
                        icon: "location",
                        href: "/locations",
                        badge: null,
                    },
                ],
            },
        ],
    },
];

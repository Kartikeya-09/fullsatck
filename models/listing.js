import { DataTypes } from "sequelize";

export default (sequelize) => {
    const Listing = sequelize.define(
        "Listing",
        {
            id: {
                type: DataTypes.INTEGER,
                autoIncrement: true,
                primaryKey: true,
            },
            title: {
                type: DataTypes.STRING,
                allowNull: false,
            },
            description: {
                type: DataTypes.TEXT,
            },
            image: {
                type: DataTypes.STRING,
                defaultValue:
                    "https://images.unsplash.com/photo-1576158114254-3ba81558b87d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8ZGVmYXVsdCUyMGltYWdlfGVufDB8fDB8fHww",
            },
            price: {
                type: DataTypes.DECIMAL(10, 2),
            },
            category: {
                type: DataTypes.ENUM(
                    "Switch Modular and Luxury",
                    "Wires",
                    "Camera Dom and Bullet",
                    "Motorised Gate and Curtain",
                    "Home Theater and Audio",
                    "Fans",
                    "Solar Panel"
                ),
                allowNull: false,
            },
        },
        {
            tableName: "listings", // Force Sequelize to use lowercase
            timestamps: false, // Remove if you want createdAt and updatedAt
        }
    );

    return Listing;
};

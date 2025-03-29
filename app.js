import dotenv from "dotenv";
dotenv.config(); // ✅ Load environment variables

import express from "express";
import { Sequelize } from "sequelize";
import jwt from "jsonwebtoken"; // ✅ Import JWT
import { fileURLToPath } from 'url';
import path from "path";
import methodOverride from "method-override"; // ✅ Import method-override
import session from "express-session"; // ✅ Import express-session
import cookieParser from "cookie-parser"; // ✅ Import cookie-parser
import flash from "connect-flash"; // ✅ Import connect-flash
import crypto from "crypto"; // Import crypto module
import userRouter from "./routes/user.js";
import listingRouter from "./routes/listing.js";
import categoryRouter from "./routes/category.js"; // ✅ Import categoryRouter
import paymentRouter from "./routes/payment.js"; // ✅ Import paymentRouter
import listingsData from "./init/data.js";
import php from "php";

// ✅ Set View Engine & Views Directory
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// ✅ Express App
const app = express();

// ✅ Middleware to parse JSON and URL-encoded data
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(methodOverride('_method')); // ✅ Use method-override
app.use(cookieParser()); // ✅ Use cookie-parser

// ✅ Serve static files from the public directory
app.use(express.static(path.join(__dirname, 'public')));

// ✅ Session Middleware
app.use(session({
    secret: process.env.SESSION_SECRET,
    resave: false,
    saveUninitialized: false,
    cookie: {
        secure: false, // Set to true if using HTTPS
        maxAge: 3600000, // 1 hour
        httpOnly: true,
        sameSite: 'Lax'
    }
}));

// ✅ Flash Middleware
app.use(flash());

// ✅ Middleware to pass flash messages to views
app.use((req, res, next) => {
    res.locals.successMessage = req.flash('success');
    res.locals.errorMessage = req.flash('error');
    next();
});

app.set('views', path.join(__dirname, 'views'))
app.set('view engine', 'php') // set PHP as a view engine in your Express app
app.engine('php', php.__express)

// ✅ Initialize Sequelize
const sequelize = new Sequelize(process.env.DB_NAME, process.env.DB_USER, process.env.DB_PASS, {
    host: process.env.DB_HOST,
    dialect: process.env.DB_DIALECT,
    logging: false,
});

// ✅ Import Models
import Listing from "./models/listing.js";
import User from "./models/user.js";

const ListingModel = Listing(sequelize);
const UserModel = User(sequelize);

// ✅ JWT Middleware
const authenticateJWT = (req, res, next) => {
    const token = req.cookies.token;
    if (!token) {
        return res.status(401).json({ message: "Access denied" });
    }
    try {
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        req.user = decoded;
        next();
    } catch (e) {
        res.status(400).json({ message: "Invalid token" });
    }
};

// ✅ Function to Initialize Database (Seed Data)
const initDB = async () => {
    try {
        await sequelize.authenticate();
        console.log("✅ Database connected successfully.");

        await sequelize.sync({ alter: true }); // ✅ Sync with alter to update schema
        console.log("✅ Models synchronized.");

        const listingsCount = await ListingModel.count();
        if (listingsCount === 0) {
            await ListingModel.bulkCreate(listingsData);
            console.log("✅ Sample listings data inserted.");
        }
    } catch (error) {
        console.error("❌ Database initialization error:", error);
    }
};

// ✅ Initialize DB before starting the server
initDB().then(() => {
    console.log("✅ Database ready!");

    // ✅ Routes
    app.use("/users", userRouter);
    app.use("/listings", listingRouter);
    app.use("/categories", categoryRouter); // ✅ Use categoryRouter
    app.use("/payment", paymentRouter); // ✅ Use paymentRouter

    // ✅ Serve landing page
    app.get("/", (req, res) => {
        res.render("listings/landing.php");
    });

    // ✅ Start Express Server
    const PORT = process.env.PORT || 3000;
    app.listen(PORT, () => {
        console.log(`🚀 Server is running on port ${PORT}`);
    });
}).catch(err => {
    console.error("❌ Error during DB init:", err);
    process.exit(1); // Exit the process with an error code
});

export { sequelize, ListingModel, UserModel };

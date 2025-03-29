import express from "express";
import path from "path";
import { fileURLToPath } from 'url';
import { isLoggedIn } from "../middlewares/auth.js"; // Import the isLoggedIn middleware

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const router = express.Router();

router.get("/qr", isLoggedIn, (req, res) => { // Apply the middleware here
    const qrImagePath = path.join(__dirname, "../public/qr.jpeg");
    res.sendFile(qrImagePath);
});

export default router;

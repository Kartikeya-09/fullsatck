import express from "express";
import * as userController from "../controllers/user.js";

const router = express.Router();

router.get("/signup", userController.renderSignUpform);
router.post("/signup", userController.signUp);
router.get("/login", userController.renderloginForm); // Render the login form
router.post("/login", userController.login); // Handle login logic
router.post("/logout", userController.logout); // Handle logout logic

export default router;
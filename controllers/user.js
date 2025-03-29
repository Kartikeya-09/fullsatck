import { UserModel } from "../app.js"; // Import the User model
import jwt from "jsonwebtoken"; // Import JWT
import bcrypt from "bcryptjs"; // Import bcryptjs for password hashing

const renderSignUpform = (req, res) => {
    res.render("users/signup.php");
};

const signUp = async (req, res) => {
    try {
        let { username, email, password } = req.body;
        const hashedPassword = await bcrypt.hash(password, 10); // Hash the password
        const newUser = await UserModel.create({ email, username, password: hashedPassword });
        const token = jwt.sign({ id: newUser.id }, process.env.JWT_SECRET, { expiresIn: '1h' }); // Generate JWT
        res.cookie('token', token, { httpOnly: true }); // Store token in cookies
        req.session.username = username; // Set username in session
        req.flash('success', 'Sign up successful. Please log in.');
        res.redirect("/users/login"); // Redirect to login page
    } catch (e) {
        req.flash('error', `Something went wrong: ${e.message}`);
        res.redirect("/users/signup");
    }
};

const renderloginForm = (req, res) => {
    res.render("users/login.php");
};

const login = async (req, res) => {
    const { email, password } = req.body;
    try {
        const user = await UserModel.findOne({ where: { email } });
        if (!user || !await bcrypt.compare(password, user.password)) {
            req.flash('error', 'Invalid email or password.');
            return res.redirect("/users/login");
        }
        const token = jwt.sign({ id: user.id }, process.env.JWT_SECRET, { expiresIn: '1h' }); // Generate JWT
        res.cookie('token', token, { httpOnly: true, secure: false, maxAge: 3600000 }); // Store token in cookies (1 hour expiration)
        req.session.username = user.username; // Set username in session
        req.flash('success', 'Login successful.');
        res.redirect("/listings"); // Redirect to listings page
    } catch (e) {
        req.flash('error', `Something went wrong: ${e.message}`);
        res.redirect("/users/login");
    }
};

const logout = (req, res) => {
    res.clearCookie('token'); // Clear the token cookie
    req.flash('success', 'Logout successful.');
    req.session.destroy(); // Destroy session
    res.redirect("/users/login"); // Redirect to login page
};

export {
    renderSignUpform,
    signUp,
    renderloginForm,
    login,
    logout,
};
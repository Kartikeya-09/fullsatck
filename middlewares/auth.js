import jwt from "jsonwebtoken";

export const isAdmin = (req, res, next) => {
    if (req.session.role === 'admin') {
        return next();
    }
    res.status(403).json({ message: "Access denied. Admins only." });
};

export const isLoggedIn = (req, res, next) => {
    const token = req.cookies.token;
    console.log("Token:", token); // Log the token for debugging
    if (!token) {
        return res.status(401).json({ message: "You must be logged in to access this feature." });
    }
    try {
        jwt.verify(token, process.env.JWT_SECRET);
        next();
    } catch (err) {
        res.status(401).json({ message: "Invalid or expired token. Please log in again." });
    }
};

import express from "express";
import { ListingModel } from "../app.js"; // Import the Listing model

const router = express.Router();

const wrapAsync = (fn) => {
    return function (req, res, next) {
        fn(req, res, next).catch(next);
    };
};

router.get("/Switch%20Modular%20and%20Luxury", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Switch Modular and Luxury" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Wires", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Wires" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Camera%20Dom%20and%20Bullet", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Camera Dom and Bullet" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Motorised%20Gate%20and%20Curtain", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Motorised Gate and Curtain" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Home%20Theater%20and%20Audio", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Home Theater and Audio" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Fans", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Fans" } });
    res.render("listings/index.php", { allListings });
}));

router.get("/Solar%20Panel", wrapAsync(async (req, res) => {
    const allListings = await ListingModel.findAll({ where: { category: "Solar Panel" } });
    res.render("listings/index.php", { allListings });
}));

export default router;
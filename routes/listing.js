import express from "express";
import {
    showAllListings,
    addNewListing,
    showIndividualListing,
    editListing,
    deleteListing,
    index,
    renderNewListingForm,
    renderEditListingForm
} from "../controllers/listing.js"; // Corrected import path
import { isAdmin } from "../middlewares/auth.js"; // Import isAdmin middleware

const router = express.Router();
router.get("/", index); // Get all listings
router.get("/api", showAllListings); // Get all listings in JSON format
router.get("/new",  renderNewListingForm); // Render new listing form
router.post("/",  addNewListing); // Add new listing
router.get("/:id", showIndividualListing); // Get one listing
router.get("/:id/edit",  renderEditListingForm); // Render edit listing form
router.put("/:id",  editListing); // Update a listing
router.delete("/:id",  deleteListing); // Delete a listing

export default router;

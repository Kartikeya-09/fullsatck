import { ListingModel } from "../app.js"; // Import the Listing model

export const index = async (req, res) => {
    try {
        const allListings = await ListingModel.findAll();
        res.render("listings/index.php", { allListings });
    } catch (err) {
        res.status(500).json({ message: "Error fetching listings", error: err });
    }
};

// ✅ Show all listings
export const showAllListings = async (req, res) => {
    try {
        const listings = await ListingModel.findAll();
        res.json(listings);
    } catch (err) {
        res.status(500).json({ message: "Error fetching listings", error: err });
    }
};

// ✅ Render new listing form
export const renderNewListingForm = (req, res) => {
    res.render("listings/new.php");
};

// ✅ Add a new listing
export const addNewListing = async (req, res) => {
    const { title, description, image, price, category } = req.body;
    try {
        const newListing = await ListingModel.create({ title, description, image, price, category });
        await newListing.save();
        res.redirect("/listings"); // ✅ Redirect to listings page
    } catch (err) {
        console.error("Error adding listing:", err); // Log the error
        res.status(500).json({ message: "Error adding listing", error: err });
    }
};

// ✅ Show individual listing by ID
export const showIndividualListing = async (req, res) => {
    const { id } = req.params;
    try {
        const listing = await ListingModel.findByPk(id);
        if (!listing) {
            return res.status(404).json({ message: "Listing not found" });
        }
        res.render("listings/show.php", { listing });  // ✅ Renders a PHP template
    } catch (err) {
        res.status(500).json({ message: "Error fetching listing", error: err });
    }
};

// ✅ Render edit listing form
export const renderEditListingForm = async (req, res) => {
    const { id } = req.params;
    try {
        const listing = await ListingModel.findByPk(id);
        if (!listing) {
            return res.status(404).json({ message: "Listing not found" });
        }
        res.render("listings/edit.php", { listing });  // ✅ Renders a PHP template
    } catch (err) {
        res.status(500).json({ message: "Error fetching listing", error: err });
    }
};

// ✅ Update listing by ID
export const editListing = async (req, res) => {
    const { id } = req.params;
    const { title, description, image, price, category } = req.body;
    try {
        const listing = await ListingModel.findByPk(id);
        if (!listing) return res.status(404).json({ message: "Listing not found" });

        await listing.update({ title, description, image, category, price });
        res.redirect(`/listings/${id}`); // ✅ Redirect to the updated listing page
    } catch (err) {
        res.status(500).json({ message: "Error updating listing", error: err });
    }
};

// ✅ Delete listing by ID
export const deleteListing = async (req, res) => {
    const { id } = req.params;
    try {
        const listing = await ListingModel.findByPk(id);
        if (!listing) return res.status(404).json({ message: "Listing not found" });

        await listing.destroy();
        res.redirect("/listings"); // ✅ Redirect to listings page after deletion
    } catch (err) {
        res.status(500).json({ message: "Error deleting listing", error: err });
    }
};


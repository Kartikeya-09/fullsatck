

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
         #filters{
      display: flex;
      flex-wrap: wrap;
      align-items: center;
    }
    .filter{
      text-align: center;
      margin-right: 2rem;
      margin-top: 2rem;
      opacity: 0.7;

    }
    .filter:hover{
      opacity: 1;
      cursor: pointer;
    }
    .filter p{
      font-size: 0.8rem;
    }

    </style>
</head>
<body>

<div id="filters">
  <div class="filter">
    <a href="/categories/Switch%20Modular%20and%20Luxury"> 
    <p>Switch Modular and Luxury</p>
  </a>
  </div>
  <div class="filter">
    <a href="/categories/Wires">
    <p>Wires</p>
  </a>
  </div>
  <div class="filter">
    <a href="/categories/Camera%20Dom%20and%20Bullet">
 
    <p>Camera Dom and Bullet</p>
  </a>
  </div>
  <div class="filter">
    <a href="/categories/Motorised%20Gate%20and%20Curtain">
    
    <p>Motorised Gate and Curtain</p>
    </a>
  </div>
  <div class="filter">
    <a href="/categories/Home%20Theater%20and%20Audio">
   
    <p>Home Theater and Audio</p>
    </a>
  </div>
  <div class="filter">
    <a href="/categories/Fans">
   
    <p>Fans</p>
    </a>
  </div>
  <div class="filter">
    <a href="/categories/Solar%20Panel">
    <p>Solar Panel</p>
    </a>
  </div>
</div>

    
    <div class="container mt-5">
        <h1 class="text-center">📋 Available Listings</h1>

            <form action="/listings/new" method="get">
                <button class="btn btn-success mb-3">Create New Listing</button>
            </form>
  
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($allListings)): ?>
                    <?php foreach ($allListings as $listing): ?>
                        <tr>
                            <td><?= htmlspecialchars($listing->id) ?></td>
                            <td>
                                <a href="/listings/<?= urlencode($listing->id) ?>">
                                    <?= htmlspecialchars($listing->title) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($listing->price) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No listings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Bootstrap JS (Optional) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Blog Title - BlogApp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f4f4f4;
      font-family: 'Segoe UI', sans-serif;
    }

    .blog-container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .blog-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .blog-meta {
      color: #6c757d;
      font-size: 0.9rem;
      margin-bottom: 30px;
    }

    .blog-image {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 30px;
    }

    .blog-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #333;
    }

    .btn-back {
      margin-top: 40px;
    }

    @media (max-width: 768px) {
      .blog-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <div class="container blog-container">
    <h1 class="blog-title">The Journey Through Rainbow Valley</h1>
    
    <div class="blog-meta">
      <span>By <strong>Vishal Kumar</strong></span> |
      <span>Category: <em>Travel</em></span> |
      <span>Published on: <time datetime="2025-06-14">June 14, 2025</time></span>
    </div>

    <img src="uploads/valley.jpg" class="blog-image" alt="Featured Image" />

    <div class="blog-content">
      <p>
        Hidden among the hills lies Rainbow Valley, a place where colors bloom beyond imagination. Every corner feels
        like a painting, with flowers dancing in hues of violet, orange, and sky blue. The journey was more than a
        trek — it was a storybook adventure waiting to be told.
      </p>

      <p>
        The mist rolled gently over the peaks as we walked, revealing secret trails and whispering winds. Every turn
        brought a new perspective, a fresh breath of life, and a reminder of nature’s unmatched beauty.
      </p>

      <p>
        If you’re looking for magic, you’ll find it here — nestled between the silence of the mountains and the heartbeat
        of the clouds.
      </p>
    </div>

    <a href="index.php" class="btn btn-outline-primary btn-back">← Back to Blogs</a>
  </div>

</body>
</html>

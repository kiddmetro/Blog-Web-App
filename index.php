<?php 

$page_name = "Home";
require_once ("./includes/header.php");
// include ("./config/function.php");

?>

    <!-- INTRO SECTION -->
    <div class="intro-section ">
        <div class="container-lg">
            <p class="section-text text-center">"Words have the power to weave stories, ignite minds, and create a world where every sentence is a journey, and every paragraph is an adventure."</p>
            <p class="side-text text-center">Embrace the art of storytelling in the tapestry of your blog, for in every word, there lies the magic to inspire, connect, and leave an indelible mark on the hearts of readers.</p>
        </div>
    </div>


    <!-- BLOG SECTION -->
    <div class="container-lg blog-section " >
        <div class="blog-section__title">
            <span class="first-text">Recently</span><span class="second-text">Posted</span>
        </div>
        
        <div class="blog-area">
            <div class="blog-post my-5">

                <?php
                // Fetch blog data from the "blogs" table in the database
                $query = "SELECT * FROM blogs";
                $result = mysqli_query($db, $query);

                // Check if any blogs are found
                if (mysqli_num_rows($result) > 0) {
                // Loop through the fetched results and generate HTML code for each blog
                while ($blog = mysqli_fetch_assoc($result)) {
                    $blogImage = $blog['image'];
                    $category = $blog['category'];
                    $blogTitle = $blog['title'];
                    $adminName = $blog['author_name'];
                    $adminImage = $blog['author_image'];
                    $readTime = $blog['read_time'];
                    $blogText = $blog['sample_text'];
                    $formattedDate =$blog['formatted_date'];
                ?>
                <div class="blog-card">
                    <a href="./page-blog.php?blog_id=<?php echo $blog['blog_id']; ?>&title=<?php echo urlencode($blog['title']); ?>&user_id=<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>&username=<?php echo isset($_SESSION['username']) ? urlencode($_SESSION['username']) : 'anonymous'; ?>"
                    class="blog-card__link" >
                        <div class="blog-img">
                            <img src="./image/cover-image/<?php echo $blogImage; ?>"  alt="" >
                        </div>
                        <div class="mt-4">
                            <h5 class="blog-category"><?php echo $category; ?></h5>
                        </div>
                        <div>
                            <h4 class="blog-title"><?php echo $blogTitle; ?></h4>
                        </div>

                        <div class="blog-info">
                            <div class="view-info">
                                <div class="blog-pic">
                                    <img src="./image/admin-image/<?php echo $adminImage; ?>" alt="">
                                </div>
                                <div class="blog-person " >
                                    <p><?php echo $adminName; ?></p>
                                </div>
                            </div>
                            <div class="blog-info__icon">
                                <i class="fa-regular fa-calendar fa-xs mt-1 me-1"></i> 
                                <p class="blog-info__icon__text"><?php echo $formattedDate; ?></p>
                            </div>
                            <div class="blog-info__icon">
                                <i class="fa-regular fa-clock fa-xs mt-1 me-1 "></i> 
                                <p class="blog-info__icon__text"><?php echo $readTime; ?> .Read</p>
                            </div>
                        </div>
                        <div class="blog-sample">
                            <p><?php echo $blogText; ?></p>
                        </div>
                    </a>
                </div>  
            <?php } ?>
        <?php } else {
            // No blogs found
            echo "No Blog found.";
        } ?>
                  

            </div>

            <div class="blog-move-buttons mb-5">
                <div>
                    
                    <button class="btn btn-outline-primary mx-2" > <i class="fa-solid fa-arrow-left me-2"></i>Prev.</button>
                </div>
                <div>
                    <button class="btn btn-outline-primary mx-2" >1</button>
                </div>
                <div>
                    <button class="btn btn-outline-primary mx-2">2</button>
                </div>
                <div>
                    <button class="btn btn-outline-primary mx-2">3</button>
                </div>
                <div>
                    <button class="btn btn-primary text-light mx-2" > Next <i class="fa-solid fa-arrow-right me-2"></i></button>
                </div>

            </div>


            
        </div>
    </div>


    <!-- FOOTER -->
    <footer class="footer mt-auto py-3 footer-bg ">
        <div class="container ">
            <div class="footer-wrapper">
                <div>
                    <a class="footer-brand" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="./image/logo/logo.svg" class="logo-image" alt=""></a>
                    <div class="footer-note" >
                        Did you come here for something in particular or just general Riker
                    </div>
                </div>

                <div class="footer-category">
                    <div class="d-flex" >
                        <ul class="footer-list" >
                            <h5 class="footer-info-header">Blogs</h5>
                            <li>Travel</li>
                            <li>Technology</li>
                            <li>Lifestyle</li>
                            <li>Fashion</li>
                            <li>Business</li>
                        </ul>

                        <ul class="footer-list" >
                            <h5 class="footer-info-header">Quick Links</h5>
                            <a href="#" class="footer-link"><li>FAQ</li></a>
                            <a href="#" class="footer-link"><li>Terms & Conditions</li></a>
                            <a href="#" class="footer-link"><li>Support</li></a>
                            <a href="#" class="footer-link"><li>Privacy Policy</li></a>
                        </ul>

                    </div>
                </div>

                <div class="footer-news">
                    <div>
                        <h5  class="footer-info-header ">Subscribe for newsletter</h5>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <div class="input-group">
                                <input type="text" class="form-control mail-btn" placeholder="Your email" name="" id="">
                                <button class="btn btn-primary px-3 text-light">Subscribe</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h5 class="footer-info-header mt-4">Follow on:</h5>
                        <div class="d-flex mt-4">
                           <div>
                                <a href="" style="text-decoration: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect width="24" height="24" rx="4" fill="#00AAA1"/>
                                        <path d="M18 9.13641C17.5584 9.32841 17.0844 9.46041 16.5864 9.51801C17.0952 9.21801 17.484 8.74281 17.6688 8.17761C17.184 8.46017 16.6549 8.65896 16.104 8.76561C15.8723 8.5227 15.5935 8.32954 15.2846 8.19791C14.9758 8.06629 14.6433 7.99895 14.3076 8.00001C12.948 8.00001 11.8464 9.08601 11.8464 10.424C11.8464 10.6136 11.868 10.7984 11.91 10.976C10.9348 10.9297 9.97994 10.6806 9.10638 10.2447C8.23281 9.80871 7.45971 9.19545 6.8364 8.44401C6.61748 8.81253 6.50221 9.23337 6.5028 9.66201C6.5028 10.502 6.9384 11.246 7.5984 11.6792C7.20773 11.667 6.82543 11.563 6.4824 11.3756V11.4056C6.48611 11.969 6.68496 12.5136 7.0451 12.9468C7.40524 13.3801 7.9044 13.6751 8.4576 13.7816C8.09443 13.8776 7.71443 13.8916 7.3452 13.8224C7.50615 14.3071 7.81401 14.7296 8.22603 15.0313C8.63805 15.333 9.13378 15.4989 9.6444 15.506C8.76836 16.1811 7.69277 16.5458 6.5868 16.5428C6.3888 16.5428 6.1932 16.5308 6 16.5092C7.12857 17.2236 8.43716 17.6019 9.7728 17.6C14.3016 17.6 16.7772 13.9064 16.7772 10.7024L16.7688 10.388C17.2516 10.0487 17.6687 9.62467 18 9.13641Z" fill="white"/>
                                    </svg>
                                </a>
                           </div>

                            <div class="footer-icon">
                                <a href="" class=" icon-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="14" viewBox="0 0 7 14" fill="none">
                                        <path d="M2.0722 14H4.54031V7.6125H6.60409L6.91576 5.1275H4.54031V3.535C4.54031 2.8175 4.73406 2.3275 5.72804 2.3275H7V0.0962499C6.78099 0.0699999 6.03129 0 5.15523 0C3.31889 0 2.0722 1.16375 2.0722 3.29V5.1275H0V7.6125H2.0722V14Z" fill="#777777"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="footer-icon">
                                <a href="" class="icon-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                        <path d="M6.97609 0.302734C5.34767 0.313786 3.7737 0.888369 2.52344 1.92819C1.27318 2.96801 0.424311 4.40846 0.122059 6.00311C-0.180194 7.59776 0.0829485 9.24753 0.86647 10.6702C1.64999 12.0928 2.9052 13.2 4.41738 13.8022C4.31575 13.1394 4.31575 12.4651 4.41738 11.8023L5.2452 8.30243C5.11419 7.98546 5.04932 7.64523 5.05455 7.30247C5.05455 6.3325 5.62148 5.60253 6.32387 5.60253C6.45111 5.60063 6.57727 5.62615 6.69369 5.67736C6.81011 5.72856 6.91405 5.80424 6.99839 5.89921C7.08273 5.99418 7.14547 6.1062 7.18232 6.22758C7.21917 6.34897 7.22926 6.47686 7.21189 6.60249C7.21189 7.20247 6.8306 8.10244 6.62991 8.93241C6.58672 9.08719 6.58158 9.25006 6.61494 9.40724C6.6483 9.56442 6.71916 9.71127 6.82154 9.83537C6.92392 9.95947 7.0548 10.0572 7.20309 10.1202C7.35138 10.1832 7.51273 10.2097 7.67346 10.1974C8.9177 10.1974 9.88098 8.88241 9.88098 6.99248C9.89349 6.60844 9.82554 6.22601 9.68146 5.8696C9.53738 5.51319 9.32034 5.19062 9.04418 4.92247C8.76802 4.65431 8.43881 4.44647 8.07755 4.31219C7.71629 4.17791 7.3309 4.12015 6.94599 4.14259C6.53504 4.125 6.12478 4.19069 5.74004 4.33569C5.35531 4.48069 5.0041 4.70198 4.70767 4.98617C4.41124 5.27036 4.17576 5.61154 4.01548 5.98905C3.8552 6.36656 3.77346 6.77256 3.77519 7.18247C3.76961 7.75352 3.94521 8.31173 4.2769 8.77741C4.30102 8.80413 4.3182 8.83633 4.32695 8.87119C4.33569 8.90605 4.33574 8.94252 4.32707 8.9774C4.27188 9.1974 4.15147 9.67738 4.13141 9.77237C4.11134 9.86737 4.02605 9.92737 3.8956 9.86737C3.01761 9.45739 2.47075 8.18243 2.47075 7.15247C2.47075 4.94756 4.08124 2.91763 7.11155 2.91763C9.54484 2.91763 11.4413 4.64757 11.4413 6.96248C11.4413 9.37239 9.93617 11.3123 7.79387 11.3123C7.47981 11.3232 7.168 11.2557 6.88675 11.116C6.6055 10.9763 6.36373 10.7688 6.18339 10.5123L5.74691 12.1773C5.53767 12.8243 5.24417 13.4412 4.87393 14.0122C5.55615 14.2131 6.26476 14.3109 6.97609 14.3022C8.83895 14.3022 10.6255 13.5647 11.9427 12.252C13.26 10.9393 14 9.15891 14 7.30247C14 5.44602 13.26 3.66561 11.9427 2.35291C10.6255 1.0402 8.83895 0.302734 6.97609 0.302734Z" fill="#777777"/>
                                      </svg>
                                </a>
                            </div>

                           <div class="footer-icon">
                            <a href="" class="icon-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                    <path d="M13.9549 4.93007C13.9471 4.34126 13.8368 3.7583 13.6292 3.20728C13.4491 2.74249 13.174 2.32038 12.8215 1.96792C12.4691 1.61545 12.047 1.34039 11.5822 1.1603C11.0382 0.956109 10.4636 0.845701 9.88272 0.833774C9.13483 0.800345 8.89771 0.791016 6.99922 0.791016C5.10073 0.791016 4.8574 0.791016 4.11495 0.833774C3.53433 0.845789 2.95996 0.956195 2.41626 1.1603C1.9514 1.34026 1.52923 1.61528 1.17675 1.96776C0.824268 2.32024 0.549247 2.74242 0.36928 3.20728C0.164684 3.7508 0.054516 4.32531 0.0435362 4.90596C0.0101066 5.65463 0 5.89175 0 7.79024C0 9.68873 -5.79232e-09 9.93129 0.0435362 10.6745C0.0551977 11.256 0.164816 11.8298 0.36928 12.3748C0.549549 12.8395 0.824775 13.2615 1.17737 13.6138C1.52997 13.9661 1.95218 14.241 2.41704 14.421C2.95924 14.6334 3.53372 14.7517 4.11573 14.7708C4.86439 14.8042 5.10151 14.8143 7 14.8143C8.89849 14.8143 9.14183 14.8143 9.88427 14.7708C10.4651 14.7594 11.0398 14.6492 11.5837 14.4451C12.0484 14.2648 12.4704 13.9896 12.8228 13.6372C13.1753 13.2847 13.4504 12.8627 13.6307 12.3981C13.8352 11.8539 13.9448 11.2801 13.9565 10.6978C13.9899 9.94995 14 9.71283 14 7.81356C13.9984 5.91507 13.9984 5.67407 13.9549 4.93007ZM6.99456 11.3804C5.009 11.3804 3.40049 9.77191 3.40049 7.78635C3.40049 5.80079 5.009 4.19228 6.99456 4.19228C7.94776 4.19228 8.86193 4.57094 9.53595 5.24496C10.21 5.91898 10.5886 6.83314 10.5886 7.78635C10.5886 8.73956 10.21 9.65372 9.53595 10.3277C8.86193 11.0018 7.94776 11.3804 6.99456 11.3804ZM10.7317 4.89741C10.6216 4.89751 10.5126 4.87591 10.4108 4.83383C10.3091 4.79175 10.2167 4.73002 10.1388 4.65218C10.061 4.57433 9.99927 4.4819 9.95719 4.38018C9.91511 4.27845 9.8935 4.16943 9.8936 4.05934C9.8936 3.94933 9.91527 3.84041 9.95737 3.73877C9.99946 3.63714 10.0612 3.5448 10.139 3.46701C10.2167 3.38922 10.3091 3.32752 10.4107 3.28542C10.5124 3.24332 10.6213 3.22166 10.7313 3.22166C10.8413 3.22166 10.9502 3.24332 11.0519 3.28542C11.1535 3.32752 11.2458 3.38922 11.3236 3.46701C11.4014 3.5448 11.4631 3.63714 11.5052 3.73877C11.5473 3.84041 11.569 3.94933 11.569 4.05934C11.569 4.52269 11.1942 4.89741 10.7317 4.89741Z" fill="#777777"/>
                                    <path d="M6.99479 10.1214C8.28417 10.1214 9.32941 9.07616 9.32941 7.78678C9.32941 6.4974 8.28417 5.45215 6.99479 5.45215C5.70541 5.45215 4.66016 6.4974 4.66016 7.78678C4.66016 9.07616 5.70541 10.1214 6.99479 10.1214Z" fill="#777777"/>
                                  </svg>
                            </a>
                           </div>

                        </div>
                    </div>

                </div>

            </div>
            <hr>

        </div>
      </footer>
      
   

      <script>
        const menuBtn = document.querySelector(".menu-icon span");
        const searchBtn = document.querySelector(".search-icon");
        const cancelBtn = document.querySelector(".cancel-icon");
        const items = document.querySelector(".nav-items");
        const form = document.querySelector("form");
        menuBtn.onclick = ()=>{
          items.classList.add("active");
          menuBtn.classList.add("hide");
          searchBtn.classList.add("hide");
          cancelBtn.classList.add("show");
        }
        cancelBtn.onclick = ()=>{
          items.classList.remove("active");
          menuBtn.classList.remove("hide");
          searchBtn.classList.remove("hide");
          cancelBtn.classList.remove("show");
          form.classList.remove("active");
          cancelBtn.style.color = "#ff3d00";
        }
        searchBtn.onclick = ()=>{
          form.classList.add("active");
          searchBtn.classList.add("hide");
          cancelBtn.classList.add("show");
        }
     </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="heading-page">
                <h3 class="title title-top-detail">
                    <a href="https://lamchame.vn/thoi-su"><?php echo $product['category_names']; ?></a>
                </h3>
                <ul class="list-top-detail"></ul>
            </div>
            <h1 class="product-text-title"><?php echo $product['title'] ?></h1>
            <p class="icon-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                    class="bi bi-alarm" viewBox="0 0 16 16">
                    <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z" />
                    <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1" />
                </svg>
                <?php echo $product['updated_at'] ?>
            </p>
            <?php echo $product['content'] ?>
            <br/>
            <br/>
             <img src="<?php echo $product['image_url'] ?>" alt="" class="img-fluid">

          
          
           
                
                    <form action="product.php?id=<?php echo $product['id'] ?>" method="post">
                    <div id="comment" data-module="comment" data-objectid="20241227015134882">
                        <div class="comment-wrap mt-30">
                            <div class="comment-head flex-jcb">
                                <div class="comment-title flex-jcc">
                                    <svg viewBox="0 0 53 45" fill="none" xmlns="http://www.w3.org/2000/svg" 
                                        aria-hidden="true" width="53" height="45">
                                        <path d="M25 33a2.667 2.667 0 0 0 2.667 2.667h16L49 41V19.667A2.667 2.667 0 0 0 46.333 17H27.667A2.667 2.667 0 0 0 25 19.667V33Z" 
                                            fill="#2361FF" fill-opacity="0.6"></path>
                                        <path d="M35 25a3.333 3.333 0 0 1-3.333 3.333h-20L5 35V8.333A3.333 3.333 0 0 1 8.333 5h23.334A3.333 3.333 0 0 1 35 8.333V25Z" 
                                            fill="#1A7900" opacity="0.5"></path>
                                    </svg>
                                    
                                    Bình luận (<?php echo count($comments) ?>)
                                   
                                </div>
                                <div class="comment-action flex-jcc">
                                <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) : ?>
                                    <a href="login.php" >Đăng nhập</a>
                                    <a href="register.php" >Đăng kí</a>
                                    <span>để gửi bình luận</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="comment-box">
                         <textarea <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) : ?>
                            readonly disabled
                        <?php endif; ?> name="commentContent" class="textarea" placeholder="Bạn nghĩ gì về tin này?"></textarea>

                                
                                <div class="action">
                                    <div class="note">
                                        Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ tiếng Việt có dấu
                                    </div>
                                    <button type="submit" class="submit flex-jcc" aria-label="Gửi bình luận"  <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) : ?>
                                disabled
                            <?php endif; ?> >
                                        Gửi bình luận
                                        <svg aria-hidden="true" width="18" height="18" viewBox="0 0 32 32" fill="none" 
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 22L19 16L13 10" stroke="#F8FAFC" stroke-width="2.5" 
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
              
         
                </form>
                  
                </div>
         
           
            <div class="comment-container">
           
           <ul class="comment-list ">
           <?php foreach ($comments as $comment) : ?>
               <li>
                       </a>
                       <div class="comment-content">
                           <div class="comment-top">
                                  <b style="color: black; border-bottom: 1px solid black;"> <?php   echo $comment['users_name'] ?>  </b>
                              
                               <div class="comment-time"></div>
                           </div>
                           <div class="comment-text"><?php echo $comment['content'] ?></div>
                          
                       </div>
               </li>
               <?php endforeach; ?>
           </ul>
           
           <button type="button" name="btnCommentMore" class="comment-more" fdprocessedid="if00qm">Xem thêm bình
               luận</button>
            </div>
        </div>
    </div>
</div>

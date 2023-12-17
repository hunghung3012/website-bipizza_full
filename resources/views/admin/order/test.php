<?php 
  if (isset($_GET['submit'])) {
    echo $_GET['rate'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
      .rate {
        background-color: rgb(180, 170, 170);
        width: 300px;

    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
    </style>
</head>
<body>
  <form action="" method="GET">
  <div class="rate">
    <input class="rating-input" type="radio" id="star5" name="rate" value="5" checked />
    <label for="star5" title="text">5 stars</label>
    <input class="rating-input" type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input class="rating-input" type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input class="rating-input" type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input class="rating-input" type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
    <button id="oke" type="submit">OKE</button>
  </div>
  </form>
  <script>
    $(document).ready(function(){
      
      $('.rating-input').click(function() {
      
        // console.log($(this).val());
      }) ;
     
    })
  </script>
</body>
</html>


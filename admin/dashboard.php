<?php
/** 
 * @package 	MYPLUGIN
 * @subpackage 	MYPLUGIN/includes
 * @since 		1.0
 * @author 		JRETECH
 */
?>
<div class="wrap" id="mp-dashboard">
    <h3 class="">MP Dashboard</h3>
    <div class="mp-flex">
        <div class="mp-column-3">
            <div class="mp-cards">
                <h3 class="mp-cards-title">Lorem ipsum</h3>
                <p class="mp-cards-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, sed.</p>
                <a href="#"><button class="mp-cards-btn">View</button></a>
            </div>
        </div>
        <div class="mp-column-3">
            <div class="mp-cards">
                <h3 class="mp-cards-title">Lorem, ipsum.</h3>
                <p class="mp-cards-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam eligendi animi doloremque?</p>
                <a href="#"><button class="mp-cards-btn">View</button></a>
            </div>
        </div>
        <div class="mp-column-3">
            <div class="mp-cards">
                <h3 class="mp-cards-title">Lorem, ipsum dolor.</h3>
                <p class="mp-cards-body">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et eum laudantium magni nostrum sequi.</p>
                <a href="#"><button class="mp-cards-btn mp-cards-settings-btn-4">View</button></a>
            </div>
        </div>
    </div>
    <div class="chart-containers">
        <div class="mp-column-2">
            <canvas id="mypluginChart"></canvas>
        </div>
        <div class="mp-column-2">
            <canvas id="mypluginChart2"></canvas>
        </div>
    </div>
</div>
<?php

?>
<script>
   jQuery(document).ready(function ($) {
    mycptChart()
    mycptChart2()
    function mycptChart(){
        let products = mp_vars.posts;
    let productNames = [];
    let stock = [];
    products.forEach(product => {
      productNames.push(product.post_title);
      stock.push(product.comment_count);
    });
    let ctx = document.getElementById('mypluginChart').getContext('2d');
    let chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: productNames,
        datasets: [{
        label: 'Stock',
        data: stock,
        backgroundColor:'<?php echo  $bg_color; ?>',
        borderColor: '<?=$border_color;?>',
        borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Posts Engagements'
        },
        scales: {
        yAxes: [{
            ticks: {
            beginAtZero: true
            }
        }]
        }
    }
    });
    }
    function mycptChart2(){
    let products = mp_vars.posts;
    let productNames = [];
    let stock = [];
    products.forEach(product => {
      productNames.push(product.post_title);
      stock.push(product.comment_count);
    });
    let ctx = document.getElementById('mypluginChart2').getContext('2d');
    let chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: productNames,
        datasets: [{
        label: 'Stock',
        data: stock,
        backgroundColor:'<?php echo  $bg_color; ?>',
        borderColor: '<?=$border_color;?>',
        borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Posts Leads'
        },
        scales: {
        yAxes: [{
            ticks: {
            beginAtZero: true
            }
        }]
        },
    }
    });
    }
    })

</script>
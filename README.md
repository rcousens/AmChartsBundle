# RedEyeAmChartsBundle

`RedEyeAmChartsBundle` eases the use of AmCharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions and PHP objects to do the heavy lifting. The bundle uses the excellent JS library
[AmCharts](http://www.amcharts.com).

DRY out your chart code by writing it all in PHP!

## Content

* [License](#license)
* [How to get started / Installation](#how-to-get-started)
* Usage
    * [Make a basic line-chart](#basic-line-chart)
    * [Use mootools instead of jQuery](#use-highcharts-with-mootools)
    * [Use without a jQuery/Mootools wrapper](#use-highcharts-without-a-jquery-or-mootools-wrapper)
    * [Use js anonymous functions](#use-a-javascript-anonymous-function)
* Cookbook
    * [Pie chart with legend](#pie-chart-with-legend) (like [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend))
    * [Make a Multi-axes plot](#multi-axes-plot) (like [highcharts.com/demo/combo-multi-axes](http://www.highcharts.com/demo/combo-multi-axes))


## License
RedEyeAmChartsBundle is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.

Please note that the AmCharts JS library bundled with the project is free for commercial use provided you retain the advertisement.


## How to get started

### Installation

1. Add the following to your `composer.json` file

   ```json
       "require": {
           ...
           "redeye/amcharts-bundle": "1.*"
           ...
       }
   ```

2. Run `php composer.phar update "ob/highcharts-bundle"`

3. Register the bundle in your `app/AppKernel.php`:

   ``` php
       <?php
       ...
       public function registerBundles()
       {
           $bundles = array(
               ...
               new RedEye\AmChartsBundle\ObHighchartsBundle(),
               ...
           );
       ...
   ```
   
4. Install the static assets

   ```bash
   php app/console assets:install --symlink web
   ```

## Usage

### Basic Line Chart

In your controller ...

``` php
    <?php
    use RedEye\AmChartsBundle\AmCharts\AmChart;

    // ...
    public function chartAction()
    {
        // Chart
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $chart = new AmChart();
        $chart->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $chart->title->text('Chart Title');
        $chart->xAxis->title(array('text'  => "Horizontal axis title"));
        $chart->yAxis->title(array('text'  => "Vertical axis title"));
        $chart->series($series);

        return $this->render('::your_template.html.twig', array(
            'chart' => $chart
        ));
    }
```

In your template ...

``` html
<!-- Load jQuery from Google's CDN if needed -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="{{ asset('bundles/redeyeamcharts/js/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bundles/redeyeamcharts/js/amcharts/pie.js') }}"></script>
<script src="{{ asset('bundles/redeyeamcharts/js/amcharts/themes/none.js') }}"></script>

<script type="text/javascript">
    {{ chart(chart) }}
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !


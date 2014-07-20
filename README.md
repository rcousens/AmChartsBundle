# RCAmChartsBundle

`RCAmChartsBundle` eases the use of AmCharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions and PHP objects to do the heavy lifting. The bundle incorporates the JS charting 
library [AmCharts](http://www.amcharts.com).

DRY out your chart code by writing it all in PHP!

## Content

* [License](#license)
* [How to get started / Installation](#how-to-get-started)
* Usage
    * [Make a basic pie chart](#basic-pie-chart)
* Cookbook

## License
RCAmChartsBundle is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.

Please note that the AmCharts JS library bundled with the project is free for commercial use provided you retain the advertisement.


## How to get started

### Installation

1. Add the following to your `composer.json` file

   ```json
       "require": {
           ...
           "rcousens/amcharts-bundle": "dev-master@dev"
           ...
       }
   ```

2. Run `php composer.phar update "rcousens/amcharts-bundle"`

3. Register the bundle in your `app/AppKernel.php`:

   ``` php
       <?php
       ...
       public function registerBundles()
       {
           $bundles = array(
               ...
               new RC\AmChartsBundle\RCAmChartsBundle(),
               ...
           );
       ...
   ```

4. Install the static assets

   ```bash
   php app/console assets:install --symlink web
   ```

## Usage

### Basic Pie Chart

In your controller ...

``` php
    <?php
    use RC\AmChartsBundle\AmCharts\AmPieChart;

    // ...
    public function chartAction()
    {
        // Chart
        $pieChart = new \RC\AmChartsBundle\AmCharts\AmPieChart();
        
        $pieChart->renderTo('piechart');
        $pieChart->setTitleField('number');
        $pieChart->setValueField('column-1');
        $pieChart->addData(array('number' => '1', 'column-1' => 10));
        $pieChart->addData(array('number' => '2', 'column-1' => 40));
        $pieChart->addData(array('number' => '3', 'column-1' => 30));

        return $this->render('::template.html.twig', array(
            'chart' => $chart
        ));
    }
```

In your template ...

``` html
<!-- Load jQuery from Google's CDN if needed -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="{{ asset('bundles/rcamcharts/js/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bundles/rcamcharts/js/amcharts/pie.js') }}"></script>
<script src="{{ asset('bundles/rrcamcharts/js/amcharts/themes/none.js') }}"></script>

<script type="text/javascript">
    {{ amchart(chart) }}
</script>

<div id="piechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !


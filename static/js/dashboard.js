    var client = new Keen({
      projectId: "5b64e745c9e77c0001ea6d78",
      masterKey: "4B17301A4D08BE5B07EDAD4876420B919390893E3B53DCB34D235224EC4E0590",
      readKey: "0B63415EBF79394D682631551864E85C7ADC59238B68C94D1BAFCAB5E42F130240F96387571C97757EE77BF5680B64A97F0AF3262915F7E5E89CB6CFCA80413CEE1B88BA3D0F09317DC1E63F20A24EADE3F79076E509A1E6082AF9DE319C97CE"
      cache: {
        maxAge: 60 * 1000 // cache for 1 minute
  }    
    });
    
    // Revenue Today
    const revenue_today = new Keen.Dataviz()
      .el("#revenue_today")
      .height(240)
      .title("Revenue Today")
      .type("metric")
      .prepare();
    
    client
      .query("sum", {
        event_collection: "orders",
        filters: [{"operator":"eq","property_name":"user","property_value":52}],
        target_property: "revenue",
        timeframe: "today",
        timezone: "US/Eastern"
      })
      .then(function(res) {
        revenue_today.data(res).render();
      })
      .catch(function(err) {
        revenue_today.message(err.message);
      });

      // Number of orders per week
    var orders_per_week = new Keen.Dataviz()
      .el("#orders_per_week")
      .height(240)
      .title("Weekly Number of Orders")
      .type("areachart")
      .prepare();

  const ordersperweek = 'ordersperweek';

    client
      .query("count", {
        event_collection: "orders",
        filters: [{"operator":"eq","property_name":"user","property_value":13}],
        interval: "weekly",
        timeframe: "this_4_weeks",
        timezone: "US/Eastern",
      })
      .then(function(res) {
        orders_per_week.data(res).render();
      })
      .catch(function(err) {
        orders_per_week.message(err.message);
      });
    
    // Breakdown of Sales Per Platform

    var sales_per_source = new Keen.Dataviz()
      .el("#sales_per_source")
      .height(240)
      .title("Breakdown of Sales Per Source")
      .type("piechart")
      .prepare();

  const salespersource = 'salespersource';

    client
      .query("count", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          group_by: "app",
          timeframe: "this_7_days",
          timezone: "US/Eastern",
      })
      .then(res => {
        sales_per_source.data(res).render();
      })
      .catch(err => {
        sales_per_source.message(err.message);
      });

    // Monthly Sales
    
    var monthly_sales = new Keen.Dataviz()
      .el("#monthly_sales")
      .height(240)
      .title("Monthly Revenue")
      .type("areachart")
      .prepare();


  const monthlysales = 'monthlysales';

    client
      .query("sum", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          interval: "monthly",
          target_property: "revenue",
          timeframe: "this_1_years",
          timezone: "US/Eastern",
      })
      .then(res => {
        monthly_sales.data(res).render();
      })
      .catch(err => {
        monthly_sales.message(err.message);
      });

    // Daily Sales per Online Ordering Platform

    var daily_sales_per_platform = new Keen.Dataviz()
      .el("#daily_sales_per_platform")
      .height(250)
      .title("Daily Revenue Per Platform")
      .type("columnchart")
      .prepare();


  const dailysalesperplatform = 'dailysalesperplatform';

    client
      .query("sum", {
          event_collection: "orders",
          group_by: ["app"],
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          interval: "daily",
          target_property: "revenue",
          timeframe: "this_7_days",
          timezone: "US/Eastern",
      })
      .then(res => {
        daily_sales_per_platform.data(res).render();
      })
      .catch(err => {
        daily_sales_per_platform.message(err.message);
      });

    // Weekly Sales

    var weekly_sales = new Keen.Dataviz()
      .el("#weekly_sales")
      .height(250)
      .title("Weekly Revenue")
      .type("areachart")
      .prepare();

  const weeklysales = 'weeklysales';

    client
      .query("sum", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          interval: "daily",
          target_property: "revenue",
          timeframe: "this_7_days",
          timezone: "US/Eastern",
      })
      .then(res => {
        weekly_sales.data(res).render();
      })
      .catch(err => {
        weekly_sales.message(err.message);
      });

    // Average Order Value For This Month

    var average_order_value = new Keen.Dataviz()
      .el("#average_order_value")
      .height(240)
      .title("Average Order Value For This Month")
      .type("metric")
      .prepare();

  const averageordervalue = 'averageordervalue';

    client
      .query("average", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          target_property: "revenue",
          timeframe: "this_month",
          timezone: "US/Eastern",
      })
      .then(res => {
        average_order_value.data(res).render();
      })
      .catch(err => {
        average_order_value.message(err.message);
      });
    
      // Average Order Value Per Platform This Month

    var average_order_value_per_platform = new Keen.Dataviz()
      .el("#average_order_value_per_platform")
      .height(250)
      .title("Average Order Value Per Platform This Month")
      .type("columnchart")
      .prepare();

  const averageordervalueperplatform = 'averageordervalueperplatform';

    client
      .query("average", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          group_by: ["app"],
          target_property: "revenue",
          timeframe: "this_14_days",
          timezone: "US/Eastern",
      })
      .then(res => {
        average_order_value_per_platform.data(res).render();
      })
      .catch(err => {
        average_order_value_per_platform.message(err.message);
      });

    // Taxes Per Year, Monthly

    var taxes = new Keen.Dataviz()
      .el("#taxes")
      .height(250)
      .title("Monthly Taxes Paid")
      .type("linechart")
      .prepare();

  const taxes_monthly = 'taxes_monthly';

    client
      .query("sum", {
          event_collection: "orders",
          filters: [{"operator":"eq","property_name":"user","property_value":13}],
          interval: "monthly",
          target_property: "tax",
          timeframe: "this_1_years",
          timezone: "US/Eastern",
      })
      .then(res => {
        taxes.data(res).render();
      })
      .catch(err => {
        taxes.message(err.message);
      });
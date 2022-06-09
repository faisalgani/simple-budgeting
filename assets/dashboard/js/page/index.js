"use strict";

if ($("#message-list").length) {
  $("#message-list").css({
    height: 400
  }).niceScroll();
}

/* chart shadow */
var draw = Chart.controllers.line.prototype.draw;
Chart.controllers.lineShadow = Chart.controllers.line.extend({
  draw: function () {
    draw.apply(this, arguments);
    var ctx = this.chart.chart.ctx;
    var _stroke = ctx.stroke;
    ctx.stroke = function () {
      ctx.save();
      ctx.shadowColor = '#00000075';
      ctx.shadowBlur = 10;
      ctx.shadowOffsetX = 8;
      ctx.shadowOffsetY = 8;
      _stroke.apply(this, arguments)
      ctx.restore();
    }
  }
});






var chart = new ApexCharts(
  document.querySelector("#chart2"),
  options
);

chart.render();


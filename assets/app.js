function drawBarChart(canvasId, labels, values) {
  const canvas = document.getElementById(canvasId);
  if (!canvas || !labels.length) return;
  new Chart(canvas, {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Number of requests', data: values }] },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
      plugins: { legend: { display: false } }
    }
  });
}

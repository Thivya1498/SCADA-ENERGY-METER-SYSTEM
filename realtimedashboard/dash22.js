// Initialize empty data arrays to hold the voltage values for each phase
  let dataL1 = [];
  let dataL2 = [];
  let dataL3 = [];
  let dataL12 = [];
  let dataL32 = [];
  let dataL13 = [];
  let dataCurrentL1 = [];
  let dataCurrentL2 = [];
  let dataCurrentL3 = [];
  let dataActiveL1 = [];
  let dataActiveL2 = [];
  let dataActiveL3 = [];
  let dataReactiveL1 = [];
  let dataReactiveL2 = [];
  let dataReactiveL3 = [];
  let dataApparentL1 = [];
  let dataApparentL2 = [];
  let dataApparentL3 = [];
  let dataPhaseAngleVoltageL1 = [];
  let dataPhaseAngleVoltageL2 = [];
  let dataPhaseAngleVoltageL3 = [];
  let dataPhaseAngleCurrentL1 = [];
  let dataPhaseAngleCurrentL2 = [];
  let dataPhaseAngleCurrentL3 = [];
  let dataFrequency = [];
  let dataTHDL1 = [];
  let dataTHDL2 = [];
  let dataTHDL3 = [];
  let dataPowerFactorL1 = [];
  let dataPowerFactorL2 = [];
  let dataPowerFactorL3 = [];


  // Function to update the voltage values on the HTML page and chart
  function updateVoltageValues(newData) {
      // Update voltage values (L1, L2, L3) on the HTML page
      const l1ValueSpan = document.getElementById('l1Value');
      const l2ValueSpan = document.getElementById('l2Value');
      const l3ValueSpan = document.getElementById('l3Value');

      l1ValueSpan.textContent = newData.L1;
      l2ValueSpan.textContent = newData.L2;
      l3ValueSpan.textContent = newData.L3;

      // Add the new data to the data arrays for each phase
      const currentTime = new Date().getTime();
      dataL1.push({ x: currentTime, y: parseFloat(newData.L1) });
      dataL2.push({ x: currentTime, y: parseFloat(newData.L2) });
      dataL3.push({ x: currentTime, y: parseFloat(newData.L3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints = 30; // You can adjust this as needed
      if (dataL1.length > maxDataPoints) {
          dataL1.shift();
      }
      if (dataL2.length > maxDataPoints) {
          dataL2.shift();
      }
      if (dataL3.length > maxDataPoints) {
          dataL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart.updateSeries([
          { name: 'L1 Voltage', data: dataL1 },
          { name: 'L2 Voltage', data: dataL2 },
          { name: 'L3 Voltage', data: dataL3 }
      ]);

      // Update voltage values (L12, L32, L13) on the HTML page
      const l12ValueSpan = document.getElementById('l12Value');
      const l32ValueSpan = document.getElementById('l32Value');
      const l13ValueSpan = document.getElementById('l13Value');

      l12ValueSpan.textContent = newData.L12;
      l32ValueSpan.textContent = newData.L32;
      l13ValueSpan.textContent = newData.L13;

      // Add the new data to the data arrays for each phase
      const currentTime2 = new Date().getTime();
      dataL12.push({ x: currentTime2, y: parseFloat(newData.L12) });
      dataL32.push({ x: currentTime2, y: parseFloat(newData.L32) });
      dataL13.push({ x: currentTime2, y: parseFloat(newData.L13) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints2 = 30; // You can adjust this as needed
      if (dataL12.length > maxDataPoints2) {
          dataL12.shift();
      }
      if (dataL32.length > maxDataPoints2) {
          dataL32.shift();
      }
      if (dataL13.length > maxDataPoints2) {
          dataL13.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart2.updateSeries([
          { name: 'L12 Voltage', data: dataL12 },
          { name: 'L32 Voltage', data: dataL32 },
          { name: 'L13 Voltage', data: dataL13 }
      ]);

      // Update voltage values (currentL1, currentL2, currentL3) on the HTML page
      const currentl1Span = document.getElementById('currentl1_value');
      const currentl2Span = document.getElementById('currentl2_value');
      const currentl3Span = document.getElementById('currentl3_value');

      currentl1Span.textContent = newData.CurrentL1;
      currentl2Span.textContent = newData.CurrentL2;
      currentl3Span.textContent = newData.CurrentL3;

      // Add the new data to the data arrays for each phase
      const currentTime3 = new Date().getTime();
      dataCurrentL1.push({ x: currentTime3, y: parseFloat(newData.CurrentL1) });
      dataCurrentL2.push({ x: currentTime3, y: parseFloat(newData.CurrentL2) });
      dataCurrentL3.push({ x: currentTime3, y: parseFloat(newData.CurrentL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints3 = 30; // You can adjust this as needed
      if (dataCurrentL1.length > maxDataPoints3) {
          dataCurrentL1.shift();
      }
      if (dataCurrentL2.length > maxDataPoints3) {
          dataCurrentL2.shift();
      }
      if (dataCurrentL3.length > maxDataPoints3) {
          dataCurrentL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart3.updateSeries([
          { name: 'Current L1', data:  dataCurrentL1 },
          { name: 'Current L2', data:  dataCurrentL2 },
          { name: 'Current L3', data:  dataCurrentL3 }
      ]);

      // Update voltage values (actpowerL1, L2, L3) on the HTML page
      const activePowerL1Span = document.getElementById('ActivePowerl1_value');
      const activePowerL2Span = document.getElementById('ActivePowerl2_value');
      const activePowerL3Span = document.getElementById('ActivePowerl3_value');

      activePowerL1Span.textContent = newData.ActiveL1;
      activePowerL2Span.textContent = newData.ActiveL2;
      activePowerL3Span.textContent = newData.ActiveL3;

      // Add the new data to the data arrays for each phase
      const currentTime4 = new Date().getTime();
      dataActiveL1.push({ x: currentTime4, y: parseFloat(newData.ActiveL1) });
      dataActiveL2.push({ x: currentTime4, y: parseFloat(newData.ActiveL2) });
      dataActiveL3.push({ x: currentTime4, y: parseFloat(newData.ActiveL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints4 = 10; // You can adjust this as needed
      if (dataActiveL1.length > maxDataPoints4) {
          dataActiveL1.shift();
      }
      if (dataActiveL2.length > maxDataPoints4) {
          dataActiveL2.shift();
      }
      if (dataActiveL3.length > maxDataPoints4) {
          dataActiveL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart4.updateSeries([
          { name: 'Active Power L1', data: dataActiveL1 },
          { name: 'Active Power L2', data: dataActiveL2 },
          { name: 'Active Power L3', data: dataActiveL3 }
      ]);

      // Update voltage values (react powerL1, L2, L3) on the HTML page
      const reactivePowerL1Span = document.getElementById('ReactivePowerl1_value');
      const reactivePowerL2Span = document.getElementById('ReactivePowerl2_value');
      const reactivePowerL3Span = document.getElementById('ReactivePowerl3_value');

      reactivePowerL1Span.textContent = newData.ReactiveL1;
      reactivePowerL2Span.textContent = newData.ReactiveL2;
      reactivePowerL3Span.textContent = newData.ReactiveL3;

      // Add the new data to the data arrays for each phase
      const currentTime5 = new Date().getTime();
      dataReactiveL1.push({ x: currentTime5, y: parseFloat(newData.ReactiveL1) });
      dataReactiveL2.push({ x: currentTime5, y: parseFloat(newData.ReactiveL2) });
      dataReactiveL3.push({ x: currentTime5, y: parseFloat(newData.ReactiveL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints5 = 30; // You can adjust this as needed
      if (dataReactiveL1.length > maxDataPoints5) {
          dataReactiveL1.shift();
      }
      if (dataReactiveL2.length > maxDataPoints5) {
          dataReactiveL2.shift();
      }
      if (dataReactiveL3.length > maxDataPoints5) {
          dataReactiveL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart5.updateSeries([
          { name: 'React Power L1', data: dataReactiveL1 },
          { name: 'React Power L2', data: dataReactiveL2 },
          { name: 'React Power L3', data: dataReactiveL3 }
      ]);

      // Update voltage values (apprt powerL1, L2, L3) on the HTML page
      const apparentPowerL1Span = document.getElementById('ApparentPowerl1_value');
      const apparentPowerL2Span = document.getElementById('ApparentPowerl2_value');
      const apparentPowerL3Span = document.getElementById('ApparentPowerl3_value');

      apparentPowerL1Span.textContent = newData.ApparentL1;
      apparentPowerL2Span.textContent = newData.ApparentL2;
      apparentPowerL3Span.textContent = newData.ApparentL3;

      // Add the new data to the data arrays for each phase
      const currentTime6 = new Date().getTime();
      dataApparentL1.push({ x: currentTime6, y: parseFloat(newData.ApparentL1) });
      dataApparentL2.push({ x: currentTime6, y: parseFloat(newData.ApparentL2) });
      dataApparentL3.push({ x: currentTime6, y: parseFloat(newData.ApparentL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints6 = 30; // You can adjust this as needed
      if (dataApparentL1.length > maxDataPoints6) {
          dataApparentL1.shift();
      }
      if (dataApparentL2.length > maxDataPoints6) {
          dataApparentL2.shift();
      }
      if (dataApparentL3.length > maxDataPoints6) {
          dataApparentL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart6.updateSeries([
          { name: 'Apprt Power L1', data: dataApparentL1 },
          { name: 'Apprt Power L2', data: dataApparentL1 },
          { name: 'Apprt Power L3', data: dataApparentL1 }
      ]);

      // Update voltage values (phase agl voltage L1, L2, L3) on the HTML page
      const phaseAngleVoltageL1Span = document.getElementById('PhaseAngleVoltagel1_value');
      const phaseAngleVoltageL2Span = document.getElementById('PhaseAngleVoltagel2_value');
      const phaseAngleVoltageL3Span = document.getElementById('PhaseAngleVoltagel3_value');

      phaseAngleVoltageL1Span.textContent = newData.PhaseAngleVoltageL1;
      phaseAngleVoltageL2Span.textContent = newData.PhaseAngleVoltageL2;
      phaseAngleVoltageL3Span.textContent = newData.PhaseAngleVoltageL3;

      // Add the new data to the data arrays for each phase
      const currentTime7 = new Date().getTime();
      dataPhaseAngleVoltageL1.push({ x: currentTime7, y: parseFloat(newData.PhaseAngleVoltageL1) });
      dataPhaseAngleVoltageL2.push({ x: currentTime7, y: parseFloat(newData.PhaseAngleVoltageL2) });
      dataPhaseAngleVoltageL3.push({ x: currentTime7, y: parseFloat(newData.PhaseAngleVoltageL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints7 = 30; // You can adjust this as needed
      if (dataPhaseAngleVoltageL1.length > maxDataPoints7) {
          dataPhaseAngleVoltageL1.shift();
      }
      if (dataPhaseAngleVoltageL2.length > maxDataPoints7) {
          dataPhaseAngleVoltageL2.shift();
      }
      if (dataPhaseAngleVoltageL3.length > maxDataPoints7) {
          dataPhaseAngleVoltageL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart7.updateSeries([
          { name: 'Phase Agl Volt L1', data: dataPhaseAngleVoltageL1 },
          { name: 'Phase Agl Volt L2', data: dataPhaseAngleVoltageL2 },
          { name: 'Phase Agl Volt L3', data: dataPhaseAngleVoltageL3 }
      ]);

      // Update voltage values (phase agl current L1, L2, L3) on the HTML page
      const phaseAngleCurrentL1Span = document.getElementById('PhaseAngleCurrentl1_value');
      const phaseAngleCurrentL2Span = document.getElementById('PhaseAngleCurrentl2_value');
      const phaseAngleCurrentL3Span = document.getElementById('PhaseAngleCurrentl3_value');

      phaseAngleCurrentL1Span.textContent = newData.PhaseAngleCurrentL1;
      phaseAngleCurrentL2Span.textContent = newData.PhaseAngleCurrentL2;
      phaseAngleCurrentL3Span.textContent = newData.PhaseAngleCurrentL3;

      // Add the new data to the data arrays for each phase
      const currentTime8 = new Date().getTime();
      dataPhaseAngleCurrentL1.push({ x: currentTime8, y: parseFloat(newData.PhaseAngleCurrentL1) });
      dataPhaseAngleCurrentL2.push({ x: currentTime8, y: parseFloat(newData.PhaseAngleCurrentL2) });
      dataPhaseAngleCurrentL3.push({ x: currentTime8, y: parseFloat(newData.PhaseAngleCurrentL3) });

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints8 = 30; // You can adjust this as needed
      if (dataPhaseAngleCurrentL1.length > maxDataPoints8) {
          dataPhaseAngleCurrentL1.shift();
      }
      if (dataPhaseAngleCurrentL2.length > maxDataPoints8) {
          dataPhaseAngleCurrentL2.shift();
      }
      if (dataPhaseAngleCurrentL3.length > maxDataPoints8) {
          dataPhaseAngleCurrentL3.shift();
      }

      // Update the chart with the new data for the corresponding series
      window.lineChart8.updateSeries([
          { name: 'Phase Agl Current L1', data: dataPhaseAngleCurrentL1 },
          { name: 'Phase Agl Current L2', data: dataPhaseAngleCurrentL2 },
          { name: 'Phase Agl Current L3', data: dataPhaseAngleCurrentL3 }
      ]);

      // Update voltage values (frequency L1, L2, L3) on the HTML page
      const frequencySpan = document.getElementById('Frequency_value');
      

      frequencySpan.textContent = newData.Frequency;
      

      // Add the new data to the data arrays for each phase
      const currentTime9 = new Date().getTime();
      dataFrequency.push({ x: currentTime9, y: parseFloat(newData.Frequency) });
      

      // Limit the number of data points displayed on the chart to keep it clean
      const maxDataPoints9 = 30; // You can adjust this as needed
      if (dataFrequency.length > maxDataPoints9) {
          dataFrequency.shift();
      }
      

      // Update the chart with the new data for the corresponding series
      window.lineChart9.updateSeries([
          { name: 'Frequency_value', data: dataFrequency },
          
      ]);

    // Update voltage values (THD L1, L2, L3) on the HTML page
    const totalHarmonicL1Span = document.getElementById('TotalHarmonicl1_value');
    const totalHarmonicL2Span = document.getElementById('TotalHarmonicl2_value');
    const totalHarmonicL3Span = document.getElementById('TotalHarmonicl3_value');

    totalHarmonicL1Span.textContent = newData.THDL1;
    totalHarmonicL2Span.textContent = newData.THDL2;
    totalHarmonicL3Span.textContent = newData.THDL3;

    // Add the new data to the data arrays for each phase
    const currentTime10 = new Date().getTime();
    dataTHDL1.push({ x: currentTime10, y: parseFloat(newData.THDL1) });
    dataTHDL2.push({ x: currentTime10, y: parseFloat(newData.THDL2) });
    dataTHDL3.push({ x: currentTime10, y: parseFloat(newData.THDL3) });

    // Limit the number of data points displayed on the chart to keep it clean
    const maxDataPoints10 = 30; // You can adjust this as needed
    if (dataTHDL1.length > maxDataPoints10) {
        dataTHDL1.shift();
    }
    if (dataTHDL2.length > maxDataPoints10) {
        dataTHDL2.shift();
    }
    if (dataTHDL3.length > maxDataPoints10) {
        dataTHDL3.shift();
    }

    // Update the chart with the new data for the corresponding series
    window.lineChart10.updateSeries([
        { name: 'Total Harmonic L1', data: dataTHDL1},
        { name: 'Total Harmonic L2', data: dataTHDL2},
        { name: 'Total Harmonic L3', data: dataTHDL3}
    ]);

    // Update voltage values (Power Fact L1, L2, L3) on the HTML page
    const powerFactorl1Span = document.getElementById('PowerFactorl1_value');
    const powerFactorL2Span = document.getElementById('PowerFactorl2_value');
    const powerFactorL3Span = document.getElementById('PowerFactorl3_value');

    powerFactorl1Span.textContent = newData.PowerFactorL1;
    powerFactorL2Span.textContent = newData.PowerFactorL2;
    powerFactorL3Span.textContent = newData.PowerFactorL3;

    // Add the new data to the data arrays for each phase
    const currentTime12 = new Date().getTime();
    dataPowerFactorL1.push({ x: currentTime12, y: parseFloat(newData.PowerFactorL1) });
    dataPowerFactorL2.push({ x: currentTime12, y: parseFloat(newData.PowerFactorL2) });
    dataPowerFactorL3.push({ x: currentTime12, y: parseFloat(newData.PowerFactorL3) });

    // Limit the number of data points displayed on the chart to keep it clean
    const maxDataPoints12 = 30; // You can adjust this as needed
    if (dataPowerFactorL1.length > maxDataPoints12) {
        dataPowerFactorL1.shift();
    }
    if (dataPowerFactorL2.length > maxDataPoints12) {
        dataPowerFactorL2.shift();
    }
    if (dataPowerFactorL3.length > maxDataPoints12) {
        dataPowerFactorL3.shift();
    }

    // Update the chart with the new data for the corresponding series
    window.lineChart12.updateSeries([
        { name: 'Power Factor L1', data: dataPowerFactorL1},
        { name: 'Power Factor L2', data: dataPowerFactorL2},
        { name: 'Power Factor L3', data: dataPowerFactorL3}
    ]);


  }

  // Create the line chart using ApexCharts
  const chartOptions = {
      chart: {
          type: 'line',
          height: 150,
          width: 300,
          animations: {
              enabled: true,
              easing: 'linear',
              dynamicAnimation: {
                  speed: 1000
              }
          },
          toolbar: {
              show: false
          }
      },
      xaxis: {
          type: 'datetime',
          title: {
              text: 'Time (s)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
        style: {
            colors: 'white' // Set x-axis tick label text color to white
        }
    }
      },
      yaxis: {
          title: {
              text: 'Voltage (V)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
            style: {
            colors: 'white' // Set y-axis tick label text color to white
          }
    }
      },
      series: [
          { name: 'L1 Voltage', data: dataL1 },
          { name: 'L2 Voltage', data: dataL2 },
          { name: 'L3 Voltage', data: dataL3 }
      ],
      legend: {
          show: true,
          position: 'top',
          onItemClick: {
              toggleDataSeries: true
          },
          labels: {
        colors: 'white' // Set legend text color to white
    }
      }
  };
   
  window.lineChart = new ApexCharts(document.querySelector("#lineChart"), chartOptions);
  window.lineChart.render();

  // Create the line chart using ApexCharts
  const chartOptions2 = {
      chart: {
          type: 'line',
          height: 150,
          width: 300,
          animations: {
              enabled: true,
              easing: 'linear',
              dynamicAnimation: {
                  speed: 1000
              }
          },
          toolbar: {
              show: false
          }
      },
      xaxis: {
          type: 'datetime',
          title: {
              text: 'Time (s)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
        style: {
            colors: 'white' // Set x-axis tick label text color to white
        }
    }
      },
      yaxis: {
          title: {
              text: 'Voltage (V)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
            style: {
            colors: 'white' // Set y-axis tick label text color to white
          }
    }
      },
      series: [
          { name: 'L12 Voltage', data: dataL12 },
          { name: 'L32 Voltage', data: dataL32 },
          { name: 'L13 Voltage', data: dataL13 }
      ],
      legend: {
          show: true,
          position: 'top',
          onItemClick: {
              toggleDataSeries: true
          },
          labels: {
        colors: 'white' // Set legend text color to white
    }
      }
  };

  window.lineChart2 = new ApexCharts(document.querySelector("#lineChart2"), chartOptions2);
  window.lineChart2.render();

  // Create the line chart using ApexCharts
  const chartOptions3 = {
      chart: {
          type: 'line',
          height: 150,
          width: 300,
          animations: {
              enabled: true,
              easing: 'linear',
              dynamicAnimation: {
                  speed: 1000
              }
          },
          toolbar: {
              show: false
          }
      },
      xaxis: {
          type: 'datetime',
          title: {
              text: 'Time (s)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
        style: {
            colors: 'white' // Set x-axis tick label text color to white
        }
    }
      },
      yaxis: {
          title: {
              text: 'Current (A)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
            style: {
            colors: 'white' // Set y-axis tick label text color to white
          }
    }
      },
      series: [
          { name: 'Current L1', data:  dataCurrentL1 },
          { name: 'Current L2', data:  dataCurrentL2 },
          { name: 'Current L3', data:  dataCurrentL3 }
      ],
      legend: {
          show: true,
          position: 'top',
          onItemClick: {
              toggleDataSeries: true
          },
          labels: {
        colors: 'white' // Set legend text color to white
    }
      }
  };

  window.lineChart3 = new ApexCharts(document.querySelector("#lineChart3"), chartOptions3);
  window.lineChart3.render();

  // Create the line chart using ApexCharts
  const chartOptions4 = {
      chart: {
          type: 'line',
          height: 150,
          width: 300,
          animations: {
              enabled: true,
              easing: 'linear',
              dynamicAnimation: {
                  speed: 1000
              }
          },
          toolbar: {
              show: false
          }
      },
      xaxis: {
          type: 'datetime',
          title: {
              text: 'Time (s)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
        style: {
            colors: 'white' // Set x-axis tick label text color to white
        }
    }
      },
      yaxis: {
          title: {
              text: 'A.Power (V)',
              style: {
              color: 'white' // Set x-axis label text color to white
            }
          },
          labels: {
            style: {
            colors: 'white' // Set y-axis tick label text color to white
          }
    }
      },
      series: [
          { name: 'Active Power L1', data: dataActiveL1 },
          { name: 'Active Power L2', data: dataActiveL2 },
          { name: 'Active Power L3', data: dataActiveL3 }
      ],
      legend: {
          show: true,
          position: 'top',
          onItemClick: {
              toggleDataSeries: true
          },
          labels: {
        colors: 'white' // Set legend text color to white
    }
      }
  };

  window.lineChart4 = new ApexCharts(document.querySelector("#lineChart4"), chartOptions4);
  window.lineChart4.render();

  const chartOptions5 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Reactive Power L1', data: dataReactiveL1 },
        { name: 'Reactive Power L2', data: dataReactiveL2 },
        { name: 'Reactive Power L3', data: dataReactiveL3 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart5 = new ApexCharts(document.querySelector("#lineChart5"), chartOptions5);
window.lineChart5.render();

const chartOptions6 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Apprt Power L1', data: dataApparentL2 },
        { name: 'Apprt Power L2', data: dataApparentL2 },
        { name: 'Apprt Power L3', data: dataApparentL2 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart6 = new ApexCharts(document.querySelector("#lineChart6"), chartOptions6);
window.lineChart6.render();

const chartOptions7 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Phase Agl Volt L1', data: dataPhaseAngleVoltageL1 },
        { name: 'Phase Agl Volt L2', data: dataPhaseAngleVoltageL2 },
        { name: 'Phase Agl Volt L3', data: dataPhaseAngleVoltageL3 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart7 = new ApexCharts(document.querySelector("#lineChart7"), chartOptions7);
window.lineChart7.render();

const chartOptions8 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Phase Agl Current L1', data: dataPhaseAngleCurrentL1 },
        { name: 'Phase Agl Current L2', data: dataPhaseAngleCurrentL2 },
        { name: 'Phase Agl Current L3', data: dataPhaseAngleCurrentL3 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart8 = new ApexCharts(document.querySelector("#lineChart8"), chartOptions8);
window.lineChart8.render();

const chartOptions9 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Frequency L1', data: dataFrequency },
        
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart9 = new ApexCharts(document.querySelector("#lineChart9"), chartOptions9);
window.lineChart9.render();

const chartOptions10 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Total Harmonic L1', data: dataTHDL1 },
        { name: 'Total Harmonic L2', data: dataTHDL2 },
        { name: 'Total Harmonic L3', data: dataTHDL3 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart10 = new ApexCharts(document.querySelector("#lineChart10"), chartOptions10);
window.lineChart10.render();

const chartOptions12 = {
    chart: {
        type: 'line',
        height: 150,
        width: 300,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
                speed: 1000
            }
        },
        toolbar: {
            show: false
        }
    },
    xaxis: {
        type: 'datetime',
        title: {
            text: 'Time (s)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
      style: {
          colors: 'white' // Set x-axis tick label text color to white
      }
  }
    },
    yaxis: {
        title: {
            text: 'A.Power (V)',
            style: {
            color: 'white' // Set x-axis label text color to white
          }
        },
        labels: {
          style: {
          colors: 'white' // Set y-axis tick label text color to white
        }
  }
    },
    series: [
        { name: 'Power Factor L1', data: dataPowerFactorL1 },
        { name: 'Power Factor L2', data: dataPowerFactorL2 },
        { name: 'Power Factor L3', data: dataPowerFactorL3 }
    ],
    legend: {
        show: true,
        position: 'top',
        onItemClick: {
            toggleDataSeries: true
        },
        labels: {
      colors: 'white' // Set legend text color to white
  }
    }
};

window.lineChart12 = new ApexCharts(document.querySelector("#lineChart12"), chartOptions12);
window.lineChart12.render();

  // WebSocket connection and event listeners
  // Establish a WebSocket connection to the server
  const socket = new WebSocket('wss://ws.reactiveclouds.com');
// Event listener for when the connection is established
  socket.onopen = function(event) {
      console.log('WebSocket connection established.');
  };

  // Event listener for receiving messages
  socket.onmessage = function(event) {
      const newData = JSON.parse(event.data);

      // Update the voltage values and line chart on the HTML page
      updateVoltageValues(newData);
  };

  // Event listener for handling errors
  socket.onerror = function(event) {
      console.error('WebSocket error:', event);
  };

  // Event listener for handling closure of the WebSocket
  socket.onclose = function(event) {
      console.log('WebSocket connection closed:', event);
  };

  ///////////////////////////////////////////////////

// // Wait for the DOM to fully load
// document.addEventListener("DOMContentLoaded", function () {
//   // Initialize gauge for Total Voltage (L1 + L2 + L3)
//   var totalVoltageGauge = new JustGage({
//     id: "totalVoltageGauge",
//     value: 0, // Initialize the gauge value to 0
//     min: 0,
//     max: 600, // Maximum value for the gauge
//     title: "Total Voltage",
//     label: "V",
//     gaugeWidthScale: 0.6,
//     counter: true,
//     levelColors: ["#00FF00", "#FFA500", "#FF0000"],
//     formatNumber: true
//   });

//   // Function to generate random voltage values for L1, L2, and L3
//   function generateRandomVoltageValues() {
//     var voltageData = {
//       L1: Math.random() * 250, // Random value for L1 between 0 and 250 V
//       L2: Math.random() * 250, // Random value for L2 between 0 and 250 V
//       L3: Math.random() * 250  // Random value for L3 between 0 and 250 V
//     };
//     return voltageData;
//   }

//   // Function to update voltage values
//   function updateVoltageValues(newData) {
//     var voltageData = generateRandomVoltageValues();
//     document.getElementById("voltageL1Value").textContent = voltageData.L1.toFixed(2) + " V";
//     document.getElementById("voltageL2Value").textContent = voltageData.L2.toFixed(2) + " V";
//     document.getElementById("voltageL3Value").textContent = voltageData.L3.toFixed(2) + " V";
//     return voltageData;
//   }

//   // Function to update the total voltage gauge
//   function updateTotalVoltageGauge() {
//     var voltageData = updateVoltageValues();
//     var totalVoltage = voltageData.L1 + voltageData.L2 + voltageData.L3;
//     totalVoltageGauge.refresh(totalVoltage.toFixed(2)); // Refresh the gauge with the new total voltage
//   }

//   // Call the function initially to set the gauge value
//   updateTotalVoltageGauge();

//   // Simulate updating the total voltage gauge value and voltage values (replace with real data update logic)
//   setInterval(updateTotalVoltageGauge, 2000); // Update every 2 seconds (adjust as needed)

  
//   // Simulate updating the chart with new data (replace with real data update logic)
//   setInterval(updateChart, 2000); // Update every 2 seconds (adjust as needed)
// });

i18next.init({
    lng: 'en', // Default language (you can change this dynamically)
    debug: true,
    resources: {
      en: {
        translation: {
            "home": "Home",
            "dashboard": "Dashboard",
            "historical_data": "Historical Data",
            "analytic_data": "Analytic Data",
            "management": "Management",
            "plant_management": "Plant Management",
            "device_management": "Device Management",
            "company_management": "Company Management",
            "alarm": "Alarm",
            "alarm_active": "Alarm Active",
            "alarm_historical": "Alarm Historical",
            "system_setting": "System Setting",
            "personal_setting": "Personal Setting",
            "delete_account": "Delete Account",
            "about_us": "About Us",
            "privacy_policy": "Privacy Policy",
            "term_of_use": "Term of Use",
            "version_information": "Version Information",
            "contact_us": "Contact Us",
            "user_name": "MupaJ",
            "user_role": "SCADA Engineer",
            "logout": "Logout",
            "total_monitored_plants": "Total Monitored Plants",
            "total_devices": "Total Devices",
            "active_devices": "Active Devices",
            "total_energy_consumption": "Total Energy Consumption"
        },
      },
      my: {
        translation: {
            "home": "Laman Utama",
            "dashboard": "Papan Pemuka",
            "historical_data": "Data Sejarah",
            "analytic_data": "Data Analitik",
            "management": "Pengurusan",
            "plant_management": "Pengurusan Tanaman",
            "device_management": "Pengurusan Peranti",
            "company_management": "Pengurusan Syarikat",
            "alarm": "Penggera",
            "alarm_active": "Penggera Aktif",
            "alarm_historical": "Penggera Sejarah",
            "system_setting": "Tetapan Sistem",
            "personal_setting": "Tetapan Peribadi",
            "delete_account": "Padam Akaun",
            "about_us": "Tentang Kami",
            "privacy_policy": "Dasar Privasi",
            "term_of_use": "Terma Penggunaan",
            "version_information": "Maklumat Versi",
            "contact_us": "Hubungi Kami",
            "user_name": "MupaJ",
            "user_role": "Jurutera SCADA",
            "logout": "Log Keluar",
            "total_monitored_plants": "Jumlah Tanaman Dipantau",
            "total_devices": "Jumlah Peranti",
            "active_devices": "Peranti Aktif",
            "total_energy_consumption": "Penggunaan Tenaga Jumlah"
          
        },
      },
      md: {
        translation: {
            "home": "首页",
            "dashboard": "仪表盘",
            "historical_data": "历史数据",
            "analytic_data": "分析数据",
            "management": "管理",
            "plant_management": "植物管理",
            "device_management": "设备管理",
            "company_management": "公司管理",
            "alarm": "警报",
            "alarm_active": "活跃警报",
            "alarm_historical": "历史警报",
            "system_setting": "系统设置",
            "personal_setting": "个人设置",
            "delete_account": "删除帐户",
            "about_us": "关于我们",
            "privacy_policy": "隐私政策",
            "term_of_use": "使用条款",
            "version_information": "版本信息",
            "contact_us": "联系我们",
            "user_name": "MupaJ",
            "user_role": "SCADA工程师",
            "logout": "注销",
            "total_monitored_plants": "总监测植物数",
            "total_devices": "总设备数",
            "active_devices": "活跃设备数",
            "total_energy_consumption": "总能耗"
          },
          
      },
    },
  });
  
// Update the changeLanguage function
function changeLanguage(lang) {
    i18next.changeLanguage(lang, (err, t) => {
      if (err) return console.log('Something went wrong loading', err);
      
      // Set HTML lang attribute
      document.documentElement.lang = lang;
      
      // Translate all elements with the data-i18n attribute
      jqueryI18next.init(i18next, $);
      $('[data-i18n]').localize(); // Use data-i18n attribute for localization
    });
  }
  
  // Add an event listener to the language-select dropdown
  document.getElementById('language-select').addEventListener('change', function () {
    const selectedLang = this.value;
    changeLanguage(selectedLang);
  });
  
  // Initialize with the default language
  changeLanguage('en');
  
const TailwindPreset = {
    button: {
        root: 'bg-teal-500 hover:bg-teal-700 active:bg-teal-900 cursor-pointer py-2 px-4 rounded-full border-0 flex gap-2',
        label: 'text-white font-bold text-lg',
        icon: 'text-white text-xl'
    },
    inputtext: {
        root: `
        w-full
        border border-gray-300 rounded-lg
        px-3 py-2 text-gray-800
        placeholder-gray-400
        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500
        transition-all duration-150
        disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed
      `
    },
    datepicker: {
        root: 'relative inline-flex items-center',
        inputtext: `
        w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800
        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500
      `,
        dropdownIcon: 'pi pi-calendar text-gray-500 absolute right-3 cursor-pointer',
        panel: 'bg-white border border-gray-200 rounded-lg shadow-lg mt-2 p-2',
        header: 'flex items-center justify-between px-3 py-2 border-b border-gray-100',
        title: 'text-gray-700 font-semibold',
        monthpicker: 'grid grid-cols-3 gap-2 p-2',
        yearpicker: 'grid grid-cols-3 gap-2 p-2',
        day: 'text-gray-700 w-9 h-9 flex items-center justify-center rounded-full cursor-pointer hover:bg-blue-100',
        day_selected: 'bg-blue-500 text-white hover:bg-blue-600',
        day_today: 'border border-blue-400',
    }
};

export default TailwindPreset;

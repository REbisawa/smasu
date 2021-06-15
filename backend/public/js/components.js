
            const MONTH_NAMES = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
            const DAYS = ['日', '月', '火', '水', '木', '金', '土'];

            function app() {
                return {
                    month: '',
                    year: '',
                    no_of_days: [],
                    blankdays: [],
                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    events: [
                        {
                            event_date: new Date(2020, 3, 1),
                            event_title: "April Fool's Day", 
                            event_text: "",
                            event_theme: 'blue'
                        },

                        {
                            event_date: new Date(2020, 3, 10),
                            event_title: "Birthday",
                            event_text: "",
                            event_theme: 'red'
                        },

                        {
                            event_date: new Date(2020, 3, 16),
                            event_title: "Upcoming Event",
                            event_text: "",
                            event_theme: 'green'
                        }
                    ],
                    event_title: '',
                    event_text: '',
                    event_date: '',
                    event_theme: 'blue',

                    themes: [
                        {
                            value: "blue",
                            label: "Blue Theme"
                        },
                        {
                            value: "red",
                            label: "Red Theme"
                        },
                        {
                            value: "yellow",
                            label: "Yellow Theme"
                        },
                        {
                            value: "green",
                            label: "Green Theme"
                        },
                        {
                            value: "purple",
                            label: "Purple Theme"
                        }
                    ],

                    openEventModal: false,
                    openEditModal: false,

                    initDate() {
                        let today = new Date();
                        this.month = today.getMonth();
                        this.year = today.getFullYear();
                        this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                    },

                    isToday(date) {
                        const today = new Date();
                        const d = new Date(this.year, this.month, date);

                        return today.toDateString() === d.toDateString() ? true : false;
                    },

                    showEventModal(date) {
                        // open the modal
                        this.openEventModal = true;
                        this.event_date = new Date(this.year, this.month, date).toDateString();
                    },

                    editEventModal(event) {
                        // console.log(event.event_date,event.event_title);
                        console.log(event.length);
                        this.openEditModal = true;
                        this.event_title = event.event_title;
                        this.event_text = event.event_text;
                        this.event_date = event.event_date;
                        this.event_theme = event.event_theme;
                    },

                    addEvent() {
                        if (this.event_title == '') {
                            console.log('title is empty');
                            return;
                        }
                        console.log(typeof(this.event_date),typeof(this.event_text), typeof(this.event_date));
                        this.events.push({
                            event_date: this.event_date,
                            event_title: this.event_title,
                            event_text: this.event_text,
                            event_theme: this.event_theme
                        });
                        
                        console.log(this.events);
                        console.log(typeof(this.events));

                        // clear the form data
                        this.event_title = '';
                        this.event_date = '';
                        this.event_text = '';
                        this.event_theme = 'blue';

                        //close the modal
                        this.openEventModal = false;
                    },

                    readEvent() {
                        // let selectMonth = String(this.year) + '-' + String(this.month+1);
                        let selectMonth = String(this.year) + '-' + ("00" + (this.month+1)).slice(-2);
                        var $this = this;
                        console.log(user_id);
                        axios.get('/admin/axios', {
                            params: {
                                month: selectMonth,
                                id: user_id 
                            }
                        })
                        .then(function(response) {
                            console.log(response);
                            for(var data in response.data){
                                var item = response.data[data];
                                console.log(item['scheduled_for']);
                                $this.event_date = new Date(item['scheduled_for']);
                                $this.event_title = item['title'];
                                $this.event_text = item['text'];
                                $this.event_theme = item['theme'] ? item['theme'] : 'blue';
                                $this.addEvent();

                            }
                            app().updateEvent(item);
                        })
                        .catch(error => {
                            console.log(error.response)
                        });
                        // console.log(this.events);
                    },

                    getNoOfDays() {
                        let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                        // find where to start calendar day of week
                        let dayOfWeek = new Date(this.year, this.month).getDay();
                        let blankdaysArray = [];
                        for ( var i=1; i <= dayOfWeek; i++) {
                            blankdaysArray.push(i);
                        }

                        let daysArray = [];
                        for ( var i=1; i <= daysInMonth; i++) {
                            daysArray.push(i);
                        }
                        
                        this.blankdays = blankdaysArray;
                        this.no_of_days = daysArray;
                    }
                }
            }
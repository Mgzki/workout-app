export default class Timer {
    // Duration of the timer, input given in seconds
    constructor() {
        this.target = new Date().getTime() + (10 * 1000);
        this.timeString = "";
    }

    // Update the timer ever 1 sec
    updateTimer() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the target date
        var distance = this.target - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        this.timeString = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            this.timeString = "EXPIRED";
        }

        return distance
    }
}
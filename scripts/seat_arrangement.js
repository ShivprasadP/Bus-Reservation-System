// Example seat selection logic
const seats = document.querySelectorAll(".seat");

seats.forEach((seat) => {
  seat.addEventListener("click", () => {
    seat.classList.toggle("selected");
    const seatNumber = seat.dataset.seat;
    console.log(`Selected seat: ${seatNumber}`);
  });
});

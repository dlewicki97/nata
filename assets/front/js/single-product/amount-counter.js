let decrease = document.querySelector("#decrease");
let increase = document.querySelector("#increase");
let amount = document.querySelector("#field-amount-input");
let amountInput = document.querySelector("#amount-input");

console.log(amount.max);

decrease.onclick = () => {
  if (amountInput.value == 1) return;
  amount.value--;
  amountInput.value--;
};
increase.onclick = () => {
  if (parseInt(amount.max) <= amount.value) return;
  amount.value++;
  amountInput.value++;
};

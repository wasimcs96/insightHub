function calibrateStickyColumns() {
  const stickyHeads = document.querySelectorAll("thead .dt-sticky-column");
  const stickyCells = document.querySelectorAll("tbody .dt-sticky-column");
  let cumulativeWidth = 0;

  for (let i = 0; i < stickyHeads.length; i++) {
    const head = stickyHeads[i];
    const width = stickyHeads[i].clientWidth;
    head.style.left = cumulativeWidth + "px";

    for (let j = 0; j < stickyCells.length; j++) {
      if (j % stickyHeads.length !== i) continue;
      const cell = stickyCells[j];
      cell.style.left = cumulativeWidth + "px";
    }

    cumulativeWidth += width;
  }
}
document.addEventListener("DOMContentLoaded", calibrateStickyColumns);
document.addEventListener("livewire:update", calibrateStickyColumns);

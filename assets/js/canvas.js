const newCanvas = () => document.createElement('canvas');

export function resize(image, scale, canvas = newCanvas()) {
    canvas.width = image.width * scale;
    canvas.height = image.height * scale;
    const ctx = canvas.getContext('2d');

    ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
    return canvas;
}

export function resizeMaxTo(image, maxSize, canvas = newCanvas()) {
    const max = Math.max(image.width, image.height);
    return resize(image, maxSize / max, canvas);
}

export function resizeMinTo(image, minSize, canvas = newCanvas()) {
    const min = Math.min(image.width, image.height);
    return resize(image, minSize / min, canvas);
}


export function cropTo(image, size, flipped = false, canvas = newCanvas()) {
    let width = image.width;
    let height = image.height;

    if (image instanceof HTMLVideoElement) {
        width = image.videoWidth;
        height = image.videoHeight;
    }

    const min = Math.min(width, height);
    const scale = size / min;
    const scaledW = Math.ceil(width * scale);
    const scaledH = Math.ceil(height * scale);
    const dx = scaledW - size;
    const dy = scaledH - size;
    canvas.width = width;
    canvas.height = height;
    // canvas.width = canvas.height = size;
    const ctx = canvas.getContext('2d');
    // ctx.drawImage(image, ~~(dx / 2) * -1, ~~(dy / 2) * -1, scaledW, scaledH);
    ctx.drawImage(image, ~~(width) * -1, ~~(height) * -1);

    if (flipped) {
        ctx.scale(-1, 1);
        ctx.drawImage(canvas, size * -1, 0);
    }

    return canvas;
}

